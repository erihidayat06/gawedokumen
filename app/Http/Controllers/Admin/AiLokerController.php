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
        $prompt = "Analisis gambar brosur lowongan kerja ini. Ekstrak informasinya dan kembalikan " .
            "HANYA dalam format JSON murni tanpa markdown, tanpa tanda ```json. " .
            "Jika informasi tidak ditemukan di gambar, kosongkan stringnya (\"\"). " .
            "Format JSON harus tepat seperti struktur ini: " .
            "{" .
            "\"posisi\": \"Nama Posisi/Jabatan\"," .
            "\"perusahaan\": \"Nama PT/Toko/Instansi\"," .
            "\"alamat\": \"Alamat lengkap penempatan jika ada\"," .
            "\"gaji\": \"Range gaji contoh: Rp 2.000.000 - Rp 2.500.000 atau kosongkan\"," .
            "\"minimal_pendidikan\": \"Pilih salah satu sesuai teks: SMP atau SMA/SMK atau D3 atau S1/S2 atau Semua Jenjang\"," .
            "\"pengalaman\": \"Pilih salah satu: Fresh Graduate atau Minimal 1 Tahun atau Minimal 2 Tahun atau Minimal 3 Tahun\"," .
            // --- PERBAIKAN DI SINI ---
            "\"deskripsi\": \"Tulis Deskripsi Pekerjaan (Job Description), lalu berikan detail lengkap di bawahnya dengan format terstruktur menggunakan baris baru (\\n) seperti berikut:\\n\\nInformasi Lowongan: [Nama Perusahaan & Wilayah]\\nInstansi: [Nama Instansi]\\nPosisi yang Dibuka: [Sebutkan semua posisi yang ada]\\nAlamat Kantor/Toko: [Alamat Lengkap]\\nCara Melamar: [Keterangan kirim berkas/email/subjek jika ada]\\nInfo Kontak HRD: [Nomor HP/WA jika ada]\"," .
            // -------------------------
            "\"tugas\": [\"Tuliskan poin tugas berupa NAMA AKTIVITAS/AKSI SAJA (maksimal 4-6 kata per poin), TANPA kalimat penjelasan panjang di belakangnya. Jika tidak ada di gambar, karang tugas yang relevan. Contoh benar: 'Membuat konsep desain grafis', 'Mengelola aset media digital', 'Membuat layout cetak'. Contoh SALAH: 'Mengembangkan konsep desain kreatif untuk berbagai platform media digital dan cetak karena hal ini penting untuk perusahaan.'\"]," .
            "\"persyaratan\": [\"Syarat 1\", \"Syarat 2\"]," .
            "\"no_wa\": \"Format angka saja diawali 628xxx jika ada\"," .
            "\"email\": \"Alamat email hrd jika ada\"" .
            "}";

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
