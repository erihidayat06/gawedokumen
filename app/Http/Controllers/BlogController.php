<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // 1. Ambil Featured Blog HANYA JIKA user tidak sedang melakukan pencarian
        $featuredBlog = null;
        if (!$search) {
            $featuredBlog = Blog::latest()->first();
        }

        // 2. Ambil artikel untuk List (dengan kondisi Pencarian & Pencegahan Duplikat)
        $blogs = Blog::query()
            ->when($search, function ($query) use ($search) {
                // Mencari berdasarkan judul atau konten
                return $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                        ->orWhere('konten', 'like', "%{$search}%");
                });
            })
            ->when($featuredBlog, function ($query) use ($featuredBlog) {
                // Biar tidak duplikat dengan Featured Blog saat kondisi normal
                return $query->where('id', '!=', $featuredBlog->id);
            })
            ->latest()
            ->paginate(8)
            ->withQueryString(); // PENTING: Biar keyword pencarian tidak hilang saat pindah halaman/pagination

        // 3. Ambil 3 artikel acak untuk Sidebar
        $recommendations = Blog::inRandomOrder()
            ->limit(3)
            ->get();

        return view('blog.index', compact('blogs', 'featuredBlog', 'recommendations'));
    }

    public function detail($kategori, $id, $slug = null)
    {
        // Cari datanya dulu berdasarkan ID
        $blog = Blog::findOrFail($id);

        // Lempar ke rute baru secara permanen (301)
        // Ini akan mengubah URL di browser user secara otomatis
        return redirect()->route('blog.show', ['slug' => $blog->slug], 301);
    }


    public function show($slug)
    {
        // Cari artikel berdasarkan slug
        $blog = Blog::where('slug', $slug)->firstOrFail();

        // Related blogs tetap pakai kategori dari data yang ditemukan
        $relatedBlogs = Blog::where('kategori', $blog->kategori)
            ->where('id', '!=', $blog->id)
            ->latest()
            ->limit(3)
            ->get();

        return view('blog.detail', compact('blog', 'relatedBlogs'));
    }
}
