<?php

namespace App\Http\Controllers\Pekerja;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuratLamaranController extends Controller
{
    public function index()
    {
        return view('pekerja.surat_lamaran.index');
    }
}
