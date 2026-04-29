<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;

class KompresGambarController extends Controller
{
    public function index()
    {
        return view('tools.kompresGambar.index');
    }
    public function store(Request $request)
    {
        $request->validate([
            'image'   => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'quality' => 'required|numeric|min:10|max:100',
            'width'   => 'required|numeric|min:100|max:5000',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;

            $img = \Intervention\Image\Laravel\Facades\Image::read($file);

            // Pastikan width diubah ke integer
            $img->scale(width: (int) $request->width);

            // SOLUSI: Tambahkan (int) sebelum $request->quality
            $encoded = $img->toJpeg(quality: (int) $request->quality);

            Storage::disk('public')->put('temp/' . $filename, (string) $encoded);

            return back()->with([
                'success' => 'Gambar berhasil dikompres!',
                'file' => $filename
            ]);
        }
    }
}
