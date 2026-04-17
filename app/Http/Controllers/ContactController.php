<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {


        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'subjek' => 'required',
            'pesan' => 'required',
        ]);


        try {
            $data = $request->all();

            Mail::send([], [], function ($message) use ($data) {
                $message->to('erihidayat549@gmail.com') // Ganti ke email yang buat neraca pesan
                    ->subject($data['subjek'])
                    ->html("
                    <h3>Pesan dari: {$data['nama']}</h3>
                    <p>Email: {$data['email']}</p>
                    <p>Isi Pesan: {$data['pesan']}</p>
                ");
            });

            return back()->with('success', 'Pesan terkirim, Lur!');
        } catch (\Exception $e) {
            // Ini biar kalau gagal, errornya kelihatan di layar
            return $e->getMessage();
        }
    }
}
