<?php

namespace App\Http\Controllers\Pekerja;

use App\Http\Controllers\Controller;
use App\Models\Cv;
use Illuminate\Http\Request;
use Nette\Utils\Json;

class CvController extends Controller
{
    public function index()
    {
        $dbTemplates = Cv::all()->map(function ($item) {
            return [
                'id'     => 'db-' . $item->id,
                'nama'   => $item->nama_template . ' (Kustom)',
                'gambar' => $item->cv_image ? asset('storage/' . $item->cv_image) : asset('img/cv/default.jpg'),
                'config' => [
                    'primary'     => $item->color_primary_text,
                    'textMain'    => $item->color_body_text,
                    'sidebarText' => $item->color_sidebar_text,
                    'bgText'      => $item->color_sidebar_bg,
                ]
            ];
        });

        // Tetap kirim sebagai string JSON
        $templates = json_encode($dbTemplates);

        return view('pekerja.cv.index', compact('templates'));
    }
}
