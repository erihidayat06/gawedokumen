<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignatureController extends Controller
{
    public function index()
    {
        return view('tools.tanda_tangan.index');
    }
}
