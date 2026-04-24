<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        // 1. Ambil 1 artikel terbaru untuk Featured
        $featuredBlog = Blog::latest()->first();

        // 2. Ambil artikel lainnya untuk List (Paginate)
        // Kita cek ID-nya agar tidak duplikat dengan yang ada di Featured
        $blogs = Blog::when($featuredBlog, function ($query) use ($featuredBlog) {
            return $query->where('id', '!=', $featuredBlog->id);
        })
            ->latest()
            ->paginate(8);

        // 3. Ambil 3 artikel acak untuk Sidebar (Rekomendasi)
        // Pastikan variabel ini ada agar view tidak error "Undefined variable"
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
