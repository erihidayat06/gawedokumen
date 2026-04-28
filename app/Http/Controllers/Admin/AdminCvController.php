<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cv;
use Intervention\Image\Laravel\Facades\Image; // Jika pakai Intervention V3
// use Intervention\Image\Facades\Image; // Jika pakai Intervention V2
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminCvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cvs = Cv::get();
        return view('admin.cv.index', compact('cvs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cv.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'cv_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'nama_template' => 'required|string',
            'color_primary_text' => 'required|string|max:7',
            'color_body_text' => 'required|string|max:7',
            'color_sidebar_bg' => 'required|string|max:7',
            'color_sidebar_text' => 'required|string|max:7',
        ]);

        // Ambil data selain gambar
        $data = $request->only([
            'nama_template',
            'color_primary_text',
            'color_body_text',
            'color_sidebar_bg',
            'color_sidebar_text'
        ]);

        // 2. Proses Gambar Jika Ada
        if ($request->hasFile('cv_image')) {
            // Definisikan folder path (Sesuai gaya kodingmu)
            $folderPath = storage_path('app/public/cv-backgrounds');

            // CEK & BUAT FOLDER jika belum ada
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            $file = $request->file('cv_image');

            // Buat nama file rapi: timestamp + slug nama.webp
            $nama_gambar = time() . '-' . Str::slug($request->full_name) . '.webp';
            $fullPath = $folderPath . '/' . $nama_gambar;

            try {
                // Konversi ke WebP menggunakan helper convertToWebp
                // Pastikan method convertToWebp() sudah ada di controller ini atau di-inherit
                $this->convertToWebp($file, $fullPath, 80);

                // Simpan path yang akan dimasukkan ke database
                // Kita simpan 'cv-backgrounds/nama_file.webp' agar asset() bisa panggil dengan benar
                $data['cv_image'] = 'cv-backgrounds/' . $nama_gambar;
            } catch (\Exception $e) {
                return back()->with('error', 'Gagal memproses gambar: ' . $e->getMessage());
            }
        }


        // 3. Simpan ke Database
        try {
            Cv::create($data);

            return redirect()->route('admin.cv.index')
                ->with('success', 'Desain CV berhasil dibuat dengan format WebP!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan ke database: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cv $cv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cv $cv)
    {
        return view('admin.cv.edit', compact('cv'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cv $cv)
    {
        // 1. Validasi Input (Hampir sama dengan store)
        $request->validate([
            'cv_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'nama_template' => 'required|string',
            'color_primary_text' => 'required|string|max:7',
            'color_body_text' => 'required|string|max:7',
            'color_sidebar_bg' => 'required|string|max:7',
            'color_sidebar_text' => 'required|string|max:7',
        ]);


        // Ambil data selain gambar
        $data = $request->only([
            'nama_template',
            'color_primary_text',
            'color_body_text',
            'color_sidebar_bg',
            'color_sidebar_text'
        ]);

        // 2. Proses Gambar Jika Ada Upload Baru
        if ($request->hasFile('cv_image')) {
            $folderPath = storage_path('app/public/cv-backgrounds');

            // Pastikan folder ada
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            // HAPUS GAMBAR LAMA jika ada di storage
            if ($cv->cv_image) {
                $oldFilePath = storage_path('app/public/' . $cv->cv_image);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); // Menghapus file fisik
                }
            }

            $file = $request->file('cv_image');

            // Buat nama file baru (Gunakan full_name dari DB atau request jika ada)
            $nama_gambar = time() . '-' . Str::slug($cv->full_name ?? 'update') . '.webp';
            $fullPath = $folderPath . '/' . $nama_gambar;

            try {
                // Konversi ke WebP
                $this->convertToWebp($file, $fullPath, 80);

                // Update path baru untuk disimpan ke database
                $data['cv_image'] = 'cv-backgrounds/' . $nama_gambar;
            } catch (\Exception $e) {
                return back()->with('error', 'Gagal memproses gambar baru: ' . $e->getMessage());
            }
        }

        // 3. Update ke Database
        try {
            $cv->update($data);

            return redirect()->route('admin.cv.index')
                ->with('success', 'Desain CV berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui database: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cv $cv)
    {
        try {
            // 1. Cek apakah ada file gambar yang tersimpan
            if ($cv->cv_image) {
                // Tentukan path lengkap file di storage
                $filePath = storage_path('app/public/' . $cv->cv_image);

                // 2. Hapus file fisik jika filenya memang ada
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // 3. Hapus data dari database
            $cv->delete();

            return redirect()->route('admin.cv.index')
                ->with('success', 'Template CV dan file gambar berhasil dihapus permanen!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    private function convertToWebp($source, $destination, $quality = 80)
    {
        $info = getimagesize($source);
        $mime = $info['mime'];

        // Buat image resource berdasarkan tipe file asli
        switch ($mime) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($source);
                break;
            case 'image/png':
                $image = imagecreatefrompng($source);
                // Penting: Jaga transparansi PNG agar tidak jadi hitam saat dikonversi
                imagepalettetotruecolor($image);
                imagealphablending($image, true);
                imagesavealpha($image, true);
                break;
            case 'image/webp':
                $image = imagecreatefromwebp($source);
                break;
            default:
                return false;
        }

        // Simpan sebagai WebP
        imagewebp($image, $destination, $quality);

        // Hapus resource dari memori
        imagedestroy($image);

        return true;
    }
}
