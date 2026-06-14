<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedLoker;

class SavedLokerController extends Controller
{
    // app/Http/Controllers/SavedLokerController.php

    public function index()
    {
        // Mengambil loker yang disimpan user beserta relasi lokernya
        $savedJobs = SavedLoker::where('user_id', auth()->id())->with('loker')->get();

        // Debugging (Opsional): Hapus ini setelah yakin datanya muncul
        // foreach ($savedJobs as $item) {
        //     echo $item->loker->posisi;
        // }

        return view('loker.save', compact('savedJobs'));
    }
    public function store(Request $request, $lokerId)
    {
        $request->user()->savedLokers()->attach($lokerId);
        return response()->json(['status' => 'success']);
    }

    public function destroy($lokerId)
    {
        auth()->user()->savedLokers()->detach($lokerId);
        return response()->json(['status' => 'success']);
    }
}
