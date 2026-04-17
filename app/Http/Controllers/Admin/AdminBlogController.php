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
            'judul' => 'required',
            'kategori' => 'required',
            'konten' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $data = $request->only(['judul', 'kategori', 'konten']);
        $data['slug'] = \Illuminate\Support\Str::slug($request->judul);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_gambar = time() . '.webp'; // Paksa ekstensi jadi .webp
            $path = public_path('uploads/blog/' . $nama_gambar);

            // Panggil fungsi helper kompres (kita buat di bawah)
            $this->convertToWebp($file, $path, 80);

            $data['gambar'] = $nama_gambar;
        }

        \App\Models\Blog::create($data);
        return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil!');
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
            'konten' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $data = $request->only(['judul', 'kategori', 'konten']);
        $data['slug'] = \Illuminate\Support\Str::slug($request->judul);

        if ($request->hasFile('gambar')) {
            // 1. Hapus gambar lama jika ada
            if ($blog->gambar && file_exists(public_path('uploads/blog/' . $blog->gambar))) {
                unlink(public_path('uploads/blog/' . $blog->gambar));
            }

            // 2. Proses gambar baru ke WebP
            $file = $request->file('gambar');
            $nama_gambar = time() . '.webp';
            $path = public_path('uploads/blog/' . $nama_gambar);

            $this->convertToWebp($file, $path, 80);
            $data['gambar'] = $nama_gambar;
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
            $path = public_path('uploads/blog_content/' . $fileName);

            // Kompres konten gambar (kualitas 70 agar ringan)
            $this->convertToWebp($file, $path, 70);

            return response()->json([
                'uploaded' => 1,
                'fileName' => $fileName,
                'url' => asset('uploads/blog_content/' . $fileName)
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
