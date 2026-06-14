<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1. Proses autentikasi
        $request->authenticate();

        // 2. Regenerasi session
        $request->session()->regenerate();

        // 3. Logika Simpan Loker Otomatis (jika user menekan simpan sebelum login)
        if ($request->filled('loker_id_to_save')) {
            // syncWithoutDetaching akan otomatis menambahkan ID jika belum ada,
            // dan tidak melakukan apa-apa jika sudah ada (menghindari duplikasi)
            auth()->user()->savedLokers()->syncWithoutDetaching([
                $request->input('loker_id_to_save')
            ]);
        }

        // 4. Redirect ke halaman asal atau dashboard
        $url = $request->input('url_intended', route('dashboard.index', absolute: false));

        return redirect($url);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Dapatkan URL asal
        $previousUrl = url()->previous();

        // Cek apakah halaman asal mengandung kata 'dashboard' atau 'admin'
        if (str_contains($previousUrl, 'dashboard') || str_contains($previousUrl, 'admin')) {
            return redirect('/'); // Ke halaman utama
        }

        // Jika bukan dari dashboard/admin, kembali ke halaman asal
        return redirect()->back();
    }
}
