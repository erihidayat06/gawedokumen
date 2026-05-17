<?php

namespace App\Http\Controllers\Pekerja;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KirimEmailController extends Controller
{
    public function index()
    {
        return view('pekerja.kirim_email.index');
    }
}
