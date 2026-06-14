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
            <div class="w-full max-w-md">
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
                        Buat Akun Baru
                    </h1>
                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        Bergabunglah hari ini untuk mulai membuat dokumen impian Anda.
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div class="space-y-2">
                        <x-input-label for="name" :value="__('Nama Lengkap')"
                            class="text-sm font-semibold text-slate-700 dark:text-slate-300" />
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required
                            autofocus placeholder="Masukkan nama Anda"
                            class="block w-full px-4 py-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200" />
                        <x-input-error :messages="$errors->get('name')" class="text-xs text-rose-500" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="email" :value="__('Alamat Email')"
                            class="text-sm font-semibold text-slate-700 dark:text-slate-300" />
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            placeholder="nama@email.com"
                            class="block w-full px-4 py-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200" />
                        <x-input-error :messages="$errors->get('email')" class="text-xs text-rose-500" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="password" :value="__('Kata Sandi')"
                            class="text-sm font-semibold text-slate-700 dark:text-slate-300" />
                        <input id="password" type="password" name="password" required placeholder="••••••••"
                            class="block w-full px-4 py-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200" />
                        <x-input-error :messages="$errors->get('password')" class="text-xs text-rose-500" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')"
                            class="text-sm font-semibold text-slate-700 dark:text-slate-300" />
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            placeholder="••••••••"
                            class="block w-full px-4 py-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200" />
                    </div>

                    {{-- Sisipkan di atas tombol "Daftar Sekarang" --}}

                    <div class="flex items-start gap-3 mt-4">
                        <div class="flex items-center h-5">
                            <input id="terms" type="checkbox" name="terms" required
                                class="w-4 h-4 text-blue-600 bg-white border-slate-300 rounded focus:ring-blue-500 dark:bg-slate-900 dark:border-slate-700">
                        </div>
                        <div class="text-sm">
                            <label for="terms" class="font-medium text-slate-600 dark:text-slate-400">
                                Saya setuju dengan
                                <button type="button" @click="showModal = true; modalView = 'terms'"
                                    class="text-blue-600 hover:underline font-bold">Syarat & Ketentuan</button>
                                dan
                                <button type="button" @click="showModal = true; modalView = 'privacy'"
                                    class="text-blue-600 hover:underline font-bold">Kebijakan Privasi</button>
                            </label>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <input type="checkbox" name="subscribe" id="subscribe" checked
                            class="mt-1 h-5 w-5 rounded border-slate-300 text-blue-600 cursor-pointer">
                        <label for="subscribe" class="text-sm text-slate-600 dark:text-slate-400">
                            Kirimkan saya pembaruan, tips, dan informasi penting lainnya melalui email.
                        </label>
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit"
                        class="w-full flex justify-center py-3.5 px-4 mt-2 border border-transparent rounded-xl shadow-lg shadow-blue-500/20 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/30 transition-all duration-200 active:scale-[0.98]">

                        {{ __('Daftar Sekarang') }}

                    </button>
                </form>

                {{-- MODAL (Diletakkan di luar form, di bagian bawah file) --}}
                <div x-show="showModal" x-cloak
                    class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm"
                    x-transition>

                    <div @click.away="showModal = false"
                        class=" rounded-2xl w-full max-w-lg max-h-[80vh] overflow-y-auto p-6 shadow-2xl">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-black text-slate-800 dark:text-white">Informasi Legal</h3>
                            <button type="button" @click="showModal = false"
                                class="text-slate-400 hover:text-slate-600 text-sm font-bold tracking-wider uppercase transition">Tutup</button>
                        </div>

                        <div class="prose dark:prose-invert max-w-none text-sm text-slate-600 dark:text-slate-400">
                            <div x-show="modalView === 'terms'">@include('pages.terms-widget')</div>
                            <div x-show="modalView === 'privacy'">@include('pages.privacy-widget')</div>
                        </div>
                    </div>
                </div>
                <div class="text-center pt-2">
                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        Sudah punya akun?
                        <a href="/login" class="font-bold text-blue-600 dark:text-blue-400 hover:underline">Masuk</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
