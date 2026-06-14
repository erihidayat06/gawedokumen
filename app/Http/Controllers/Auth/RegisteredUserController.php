<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => ['required', 'accepted'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'terms_accepted' => true,
            'terms_accepted_at' => now(),
            'is_subscribed' => $request->has('subscribe'),
        ]);

        event(new Registered($user));

        // 1. Auto-login user setelah daftar
        Auth::login($user);

        // 2. Logika Simpan Loker Otomatis (jika user mendaftar lewat tombol simpan)
        if ($request->filled('loker_id_to_save')) {
            $user->savedLokers()->attach($request->input('loker_id_to_save'));
        }

        // 3. Redirect ke halaman asal atau dashboard
        $url = $request->input('url_intended', route('dashboard.index', absolute: false));

        return redirect($url);
    }
}
