<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiLokerController extends Controller
{
    public function scanImage(Request $request)
    {
        // 1. Cek apakah file benar-benar dikirim
        if (!$request->hasFile('image')) {
            return response()->json(['success' => false, 'message' => 'Tidak ada file gambar yang diterima server.'], 400);
        }

        $image = $request->file('image');

        // 2. Validasi ekstensi secara manual agar lebih kebal dari bug mimes AJAX
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $extension = strtolower($image->getClientOriginalExtension());

        if (!in_array($extension, $allowedExtensions)) {
            return response()->json([
                'success' => false,
                'message' => 'Format file tidak didukung! Pastikan menggunakan file gambar berformat: JPG, JPEG, atau PNG.'
            ], 422);
        }

        // 3. Batasi ukuran file (Maksimal 2MB = 2048 KB)
        if ($image->getSize() > 2048 * 1024) {
            return response()->json(['success' => false, 'message' => 'Ukuran gambar terlalu besar, maksimal 2MB.'], 422);
        }

        // --- SISA KODE DI BAWAHNYA TETAP SAMA ---
        $base64Image = base64_encode(file_get_contents($image->path()));
        $mimeType = $image->getMimeType();

        $apiKey = env('GEMINI_API_KEY');
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . $apiKey;

        // 2. Buat instruksi prompt seketat mungkin agar AI me-return JSON murni
        $prompt = "Analisis gambar brosur lowongan kerja ini. Ekstrak informasinya dan kembalikan HANYA dalam format JSON murni tanpa markdown, tanpa tanda ```json. Jika informasi tidak ditemukan di gambar, kosongkan stringnya (\"\").

            Format JSON harus tepat seperti struktur berikut:
            {
            \"posisi\": \"Nama Posisi/Jabatan\",
            \"perusahaan\": \"Nama PT/Toko/Instansi\",
            \"alamat\": \"Alamat lengkap penempatan jika ada\",
      \"benefit\": [\"Kumpulkan semua poin keuntungan, fasilitas, atau bonus yang didapatkan pekerja. Pada brosur ini, ambil semua poin di bawah judul 'Keuntungan' KECUALI poin gaji pokok yang sudah dipisah ke properti gaji. Berarti array ini harus berisi poin seperti: 'Dapat uang makan', 'Uang lembur per jam (bisalembur di rumah)', 'THR', 'Bonus kenaikan omzet Ahir tahun', 'Liburan setiap akhir tahun', 'Reward jalan jalan ke Singapore'. Ekstrak menjadi array string per poin. Jika tidak ada, kosongkan ([])\"],
          \"gaji\": \"Ekstrak nilai gaji dari brosur. Jika tertulis kata 'UMK', 'UMR', atau 'Gaji Pokok Standar Daerah', cari tahu wilayah penempatan/kota di brosur tersebut (misal: Tegal, Brebes, Pemalang, dll). Konversikan kata UMK/UMR tersebut menjadi NOMINAL ANGKA BULAT SAJA yang sesuai dengan perkiraan UMK wilayah tersebut di tahun 2026. FORMAT WAJIB: Diawali 'Rp' diikuti angka dan titik pemisah ribuan, TANPA teks penjelasan apa pun di depannya atau di belakangnya. Contoh: 'Rp 2.380.000' atau 'Rp 2.110.000'. Jika benar-benar tidak ada indikasi gaji, kosongkan (\"\")\",
         \"deadline\": \"Tuliskan deadline atau batas waktu lamaran jika ada, format wajib YYYY-MM-DD (contoh: 2026-05-31). Jika tidak tertulis eksplisit atau hingga kuota terpenuhi, kosongkan saja (\"\")\",
            \"minimal_pendidikan\": \"Pilih salah satu yang paling sesuai dengan teks di gambar: SMP atau SMA/SMK atau D3 atau S1/S2 atau Semua Jenjang\",
            \"pengalaman\": \"Pilih salah satu yang paling sesuai dengan teks di gambar: Fresh Graduate atau Minimal 1 Tahun atau Minimal 2 Tahun atau Minimal 3 Tahun\",
            \"deskripsi\": \"[Tulis draf paragraf ringkas Deskripsi Pekerjaan / Job Description di sini]\\n\\nInformasi Lowongan: [Nama Perusahaan & Wilayah]\\nInstansi: [Nama Instansi]\\nPosisi yang Dibuka: [Sebutkan semua posisi yang ada]\\nAlamat Kantor/Toko: [Alamat Lengkap sesuai gambar]\\nCara Melamar: [Keterangan lengkap alur kirim berkas/email/syarat fisik cetak jika ada]\\nInfo Kontak HRD: [Nomor HP/WA jika ada]\",
            \"tugas\": [\"Poin tugas berupa NAMA AKTIVITAS/AKSI SAJA (maksimal 4-6 kata per poin), TANPA kalimat penjelasan panjang di belakangnya. Jika tidak tertulis eksplisit di gambar, buatkan tugas logis yang relevan dengan posisi tersebut. Contoh: 'Membalas chat di sosial media', 'Mengunggah konten story dan feed'\"],
            \"persyaratan\": [\"Tuliskan semua syarat, kualifikasi, dan berkas yang harus dikirim dalam bentuk array string terpisah per poin\"],
            \"no_wa\": \"Format angka saja diawali 628xxx jika nomor WA ditemukan, jika tidak ada kosongkan\",
            \"email\": \"Alamat email hrd jika ada, jika tidak ada kosongkan\"
            }";

        try {
            // 3. Request ke API Gemini
            $response = Http::post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt],
                            [
                                'inlineData' => [
                                    'mimeType' => $mimeType,
                                    'data' => $base64Image
                                ]
                            ]
                        ]
                    ]
                ]
            ]);

            // ... bagian atas controller tetap sama ...

            $result = $response->json();

            // Ambil teks dari response Gemini


            // [LOG 1] Catat respon mentah dari Gemini untuk memantau hasil generate awal
            Log::info('Gemini HTTP Status Code: ' . $response->status());
            if (!$response->successful()) {
                Log::error('Gemini API Error Detail:', [
                    'status' => $response->status(),
                    'body' => $response->body() // Di sini akan kelihatan tulisan "RESOURCE_EXHAUSTED" kalau kena limit
                ]);
            }
            $rawJson = $result['candidates'][0]['content']['parts'][0]['text'] ?? '';
            // PERBAIKAN: Deteksi dan potong kalau Gemini nakal dan tetap menyertakan backticks ```json
            if (preg_match('/```json\s*(.*?)\s*```/s', $rawJson, $matches)) {
                $cleanedJson = $matches[1];
            } else {
                $cleanedJson = trim(str_replace(['```json', '```'], '', $rawJson));
            }

            // Coba lakukan decode
            $dataLoker = json_decode($cleanedJson, true);

            // Kalau hasil decode gagal/null, kirim error JSON yang valid ke frontend, bukan crash!
            if (!$dataLoker) {
                // [LOG 2] Catat error jika JSON gagal di-parse, sertakan teks yang sudah dibersihkan
                Log::error('Gemini JSON Parse Failed!', [
                    'cleaned_json' => $cleanedJson,
                    'json_error_msg' => json_last_error_msg() // Menampilkan alasan kenapa json_decode gagal
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Format AI tidak terbaca sebagai JSON.',
                    'debug_raw' => $rawJson
                ], 422);
            }

            // [LOG 3] Opcional: Catat kalau parse JSON sukses (bisa dimatikan kalau sudah production biar log gak penuh)
            Log::info('Gemini JSON Parse Success:', ['parsed_data' => $dataLoker]);
            return response()->json([
                'success' => true,
                'data' => $dataLoker
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
