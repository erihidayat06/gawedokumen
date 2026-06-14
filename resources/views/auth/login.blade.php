<x-guest-layout>
    <div
        class="min-h-screen flex flex-col md:flex-row bg-slate-50 dark:bg-slate-950 font-sans selection:bg-blue-500 selection:text-white">

        <div
            class="hidden md:flex md:w-1/2 bg-gradient-to-br from-blue-600 via-indigo-700 to-slate-900 p-12 flex-col justify-between relative overflow-hidden">
            <div
                class="absolute top-0 right-0 -mt-12 -mr-12 w-96 h-96 bg-white/10 rounded-full blur-3xl pointer-events-none">
            </div>
            <div
                class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-blue-500/20 rounded-full blur-2xl pointer-events-none">
            </div>

            <a href="/" class="flex items-center space-x-3 group relative z-10 w-fit">
                <div
                    class="bg-white/10 backdrop-blur-md p-2.5 rounded-xl group-hover:rotate-12 transition-all duration-300 shadow-xl shadow-black/10 border border-white/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <span class="self-center text-2xl font-bold whitespace-nowrap tracking-tight text-white">
                    Gawe<span class="text-blue-300">Dokumen</span>
                </span>
            </a>

            <div class="relative z-10 my-auto max-w-md space-y-4">
                <h2 class="text-4xl font-extrabold text-white tracking-tight leading-tight">
                    Administrasi Jadi Mudah, Cepat, dan Profesional.
                </h2>
                <p class="text-slate-200 text-base leading-relaxed font-medium">
                    GaweDokumen membantu Anda menyusun berbagai dokumen administrasi, mulai dari surat lamaran kerja,
                    CV, hingga keperluan formal lainnya dengan template yang rapi.
                </p>
                <div class="pt-4 flex items-center space-x-3 text-sm text-blue-200 font-semibold">
                    <span class="flex h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Template otomatis & siap pakai</span>
                </div>
            </div>

            <div class="relative z-10 text-sm text-slate-300/80">
                &copy; {{ date('Y') }} GaweDokumen. All rights reserved.
            </div>
        </div>

        <div class="w-full md:w-1/2 flex items-center justify-center p-6 sm:p-12 md:p-16 relative">
            <div class="w-full max-w-md space-y-8">

                <div class="text-center md:text-left space-y-3">
                    <div class="flex md:hidden justify-center mb-4">
                        <a href="/" class="flex items-center space-x-2 group">
                            <div
                                class="bg-blue-600 p-2 rounded-lg group-hover:rotate-12 transition-transform shadow-lg shadow-blue-500/30">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <span class="text-xl font-bold tracking-tight text-slate-900 dark:text-white">Gawe<span
                                    class="text-blue-600">Dokumen</span></span>
                        </a>
                    </div>
                    <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                        Selamat Datang Kembali
                    </h1>
                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        Silakan masuk untuk melanjutkan akses pembuatan dokumen Anda.
                    </p>
                </div>

                <x-auth-session-status
                    class="p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-200 dark:border-emerald-800 text-emerald-600 dark:text-emerald-400 text-sm font-medium shadow-sm"
                    :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div class="space-y-2">
                        <x-input-label for="email" :value="__('Alamat Email')"
                            class="text-sm font-semibold text-slate-700 dark:text-slate-300" />
                        <div class="relative rounded-xl shadow-sm">
                            <div
                                class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 dark:text-slate-500">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                                </svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                autofocus autocomplete="username" placeholder="nama@email.com"
                                class="block w-full pl-11 pr-4 py-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white rounded-xl placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-500 transition-all duration-200" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="text-xs font-medium text-rose-500 mt-1" />
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <x-input-label for="password" :value="__('Kata Sandi')"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-300" />
                            @if (Route::has('password.request'))
                                <a class="text-xs font-semibold text-blue-600 dark:text-blue-400 hover:underline transition-colors focus:outline-none"
                                    href="{{ route('password.request') }}">
                                    {{ __('Lupa kata sandi?') }}
                                </a>
                            @endif
                        </div>
                        <div class="relative rounded-xl shadow-sm">
                            <div
                                class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 dark:text-slate-500">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" type="password" name="password" required
                                autocomplete="current-password" placeholder="••••••••"
                                class="block w-full pl-11 pr-4 py-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white rounded-xl placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-500 transition-all duration-200" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="text-xs font-medium text-rose-500 mt-1" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                            <input id="remember_me" type="checkbox" name="remember"
                                class="w-4 h-4 rounded border-slate-300 dark:border-slate-800 text-blue-600 shadow-sm focus:ring-blue-500/30 focus:ring-offset-0 dark:bg-slate-900">
                            <span
                                class="ms-2.5 text-sm font-medium text-slate-600 dark:text-slate-400">{{ __('Ingat perangkat ini') }}</span>
                        </label>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-blue-500/20 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/30 transition-all duration-200 active:scale-[0.98]">
                            {{ __('Masuk ke Akun') }}
                        </button>
                    </div>
                </form>

                <div class="text-center pt-2">
                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        Belum punya akun?
                        <a href="/register"
                            class="font-bold text-blue-600 dark:text-blue-400 hover:underline transition-colors">Daftar
                            Sekarang</a>
                    </p>
                </div>

            </div>
        </div>

    </div>
</x-guest-layout>
