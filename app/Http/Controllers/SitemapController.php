<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $posts = Blog::latest()->get();

        return response()->view('sitemap', [
            'posts' => $posts,
        ])->header('Content-Type', 'text/xml');
    }
}
