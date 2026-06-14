<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-slate-50 dark:bg-slate-950 p-6">
        <div
            class="w-full max-w-lg bg-white dark:bg-slate-900 rounded-2xl shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800 p-8 sm:p-10">

            <div class="flex justify-center mb-6">
                <div class="p-4 bg-blue-100 dark:bg-blue-900/30 rounded-full">
                    <svg class="w-10 h-10 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
            </div>

            <h2 class="text-2xl font-extrabold text-center text-slate-900 dark:text-white mb-3">
                Verifikasi Email Anda
            </h2>

            <div class="text-center text-sm text-slate-600 dark:text-slate-400 mb-8 leading-relaxed">
                {{ __('Terima kasih telah mendaftar! Sebelum memulai, silakan klik tautan verifikasi yang telah kami kirimkan ke email Anda. Jika Anda tidak menerima email tersebut, silakan klik tombol di bawah untuk mengirim ulang.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div
                    class="mb-6 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 text-center">
                    <p class="text-sm font-medium text-emerald-600 dark:text-emerald-400">
                        {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                    </p>
                </div>
            @endif

            <div class="space-y-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-blue-500/20 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/30 transition-all duration-200 active:scale-[0.98]">
                        {{ __('Kirim Ulang Email Verifikasi') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 text-sm font-semibold text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200 transition-colors">
                        {{ __('Keluar Akun') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
