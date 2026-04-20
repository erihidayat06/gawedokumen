<?php

namespace App\Http\Controllers\Pekerja;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CvController extends Controller
{
    public function index()
    {
        return view('pekerja.cv.index');
    }
}
