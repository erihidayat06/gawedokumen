<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $posts = \App\Models\Blog::all();
        // Ambil hanya loker yang masih aktif untuk sitemap
        $lokers = \App\Models\Loker::where('status', 'Aktif')->get();

        return response()->view('sitemap', [
            'posts' => $posts,
            'lokers' => $lokers
        ])->header('Content-Type', 'text/xml');
    }
}
