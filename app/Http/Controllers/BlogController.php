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
        $blog = Blog::findOrFail($id);
        // Ambil artikel lain dengan kategori yang sama, tapi bukan artikel yang sedang dibuka
        $relatedBlogs = Blog::where('kategori', $kategori)
            ->where('id', '!=', $id)
            ->latest()
            ->limit(3)
            ->get();

        return view('blog.detail', compact('blog', 'relatedBlogs'));
    }
}
