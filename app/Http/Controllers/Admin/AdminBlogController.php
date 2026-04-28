<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Intervention\Image\Laravel\Facades\Image; // Jika pakai versi 3

class AdminBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'slug'     => 'required|unique:blogs,slug',
            'kategori' => 'required',
            'konten' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,webp'
        ]);

        $data = $request->only(['judul', 'kategori', 'konten', 'slug']);




        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_gambar = time() . '.webp';

            // 1. Arahkan ke folder storage/app/public/...
            $folderPath = storage_path('app/public/uploads/blog');

            // 2. Buat folder jika belum ada di storage
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            $fullPath = $folderPath . '/' . $nama_gambar;

            try {
                $this->convertToWebp($file, $fullPath, 80);
                $data['gambar'] = $nama_gambar;
            } catch (\Exception $e) {
                return back()->with('error', 'Gagal memproses gambar: ' . $e->getMessage());
            }
        }

        \App\Models\Blog::create($data);
        return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil diterbitkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $blog = Blog::where('slug', $blog->slug)->firstOrFail();

        // Ambil 3 artikel lain untuk sidebar
        $related = Blog::where('id', '!=', $blog->id)->latest()->take(3)->get();

        return view('admin.blog.show', compact('blog', 'related'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $blog = \App\Models\Blog::findOrFail($blog->id);
        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $blog = \App\Models\Blog::findOrFail($blog->id);

        $request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'slug'     => 'required|unique:blogs,slug,' . $blog->id,
            'konten' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $data = $request->only(['judul', 'kategori', 'konten', 'slug']);


        if ($request->hasFile('gambar')) {
            // 1. Definisikan folder path
            $folderPath = storage_path('app/public/uploads/blog');

            // 2. CEK & BUAT FOLDER (Jaga-jaga kalau folder hilang/belum ada)
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            // 3. HAPUS GAMBAR LAMA
            // Gunakan @ sebelum unlink agar tidak error jika file fisik sudah hilang duluan
            if ($blog->gambar) {
                $oldPath = $folderPath . '/' . $blog->gambar;
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }

            // 4. PROSES GAMBAR BARU
            $file = $request->file('gambar');
            $nama_gambar = time() . '.webp';
            $fullPath = $folderPath . '/' . $nama_gambar;

            try {
                // Konversi ke WebP menggunakan helper yang sudah kita buat
                $this->convertToWebp($file, $fullPath, 80);
                $data['gambar'] = $nama_gambar;
            } catch (\Exception $e) {
                // Jika gagal konversi, kembalikan error agar data database tidak ikut rusak
                return back()->with('error', 'Gagal memproses gambar baru: ' . $e->getMessage());
            }
        }

        $blog->update($data);

        return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog = \App\Models\Blog::findOrFail($blog->id);

        // Hapus gambar dari folder
        if ($blog->gambar && file_exists(public_path('uploads/blog/' . $blog->gambar))) {
            unlink(public_path('uploads/blog/' . $blog->gambar));
        }

        $blog->delete();
        return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil dihapus!');
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = time() . '_' . uniqid() . '.webp';

            // Gunakan storage_path untuk proses simpan
            $folderPath = storage_path('app/public/uploads/blog_content/');
            $fullPath = $folderPath . $fileName;

            // Validasi: Buat folder jika belum ada
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0775, true);
            }

            // Pastikan fungsi convertToWebp kamu menerima FULL PATH (termasuk nama file)
            // Dan pastikan fungsi tersebut menggunakan imagewebp($image, $fullPath, $quality)
            $this->convertToWebp($file, $fullPath, 70);

            return response()->json([
                'uploaded' => 1,
                'fileName' => $fileName,
                // Asset() akan mengarah ke folder public/storage/ jika sudah php artisan storage:link
                'url' => asset('storage/uploads/blog_content/' . $fileName)
            ]);
        }
    }


    /**
     * Fungsi Helper Native PHP untuk Kompres ke WebP
     */
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
