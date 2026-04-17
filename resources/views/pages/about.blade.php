@extends('layouts.app')

@section('content')
    <div class="bg-white dark:bg-slate-950 min-h-screen pb-20 overflow-hidden">
        <div class="relative pt-24 pb-16 px-6">
            <div
                class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[500px] bg-gradient-to-b from-blue-50/50 to-transparent dark:from-blue-950/20 -z-10">
            </div>

            <div class="max-w-4xl mx-auto text-center">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 dark:bg-blue-900/30 border border-blue-100 dark:border-blue-800 mb-8 animate-fade-in">
                    <span class="relative flex h-2 w-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                    </span>
                    <span class="text-xs font-bold text-blue-600 dark:text-blue-400 uppercase tracking-widest">The Future of
                        Documents</span>
                </div>

                <h1 class="text-5xl md:text-7xl font-black text-slate-900 dark:text-white tracking-tight mb-8">
                    Isi From. Klik. <br> <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500">Jadi Berkas.</span>
                </h1>
                <p class="text-xl text-slate-500 dark:text-slate-400 leading-relaxed max-w-2xl mx-auto">
                    GaweDokumen generator dokumen berstandar profesional. Platfrom yang mengutamakan
                    kemudahan, kecepatan dan privasi bagi setiap penggunanya.
                </p>
            </div>
        </div>

        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-6">

            <div
                class="md:col-span-2 p-8 md:p-12 rounded-[2rem] bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-800 relative overflow-hidden group">
                <div class="relative z-10">
                    <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-6">Misi Kami</h2>
                    <p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed mb-8">
                        Kami hadir untuk menghapus hambatan administratif bagi pelamar kerja dan pelajar Indonesia. Hanya
                        dengan menulis data pada form
                        automasi cerdas, kami memastikan siapa pun bisa memiliki dokumen berstandar profesional dalam
                        hitungan detik.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <span
                            class="px-4 py-2 bg-white dark:bg-slate-800 rounded-xl shadow-sm text-sm font-medium dark:text-white border border-slate-200 dark:border-slate-700">🚀
                            Fast Rendering</span>
                        <span
                            class="px-4 py-2 bg-white dark:bg-slate-800 rounded-xl shadow-sm text-sm font-medium dark:text-white border border-slate-200 dark:border-slate-700">🛡️
                            Zero-Data Storage</span>
                        <span
                            class="px-4 py-2 bg-white dark:bg-slate-800 rounded-xl shadow-sm text-sm font-medium dark:text-white border border-slate-200 dark:border-slate-700">🎨
                            Pro Layouts</span>
                    </div>
                </div>
                <div
                    class="absolute -bottom-10 -right-10 w-64 h-64 bg-blue-500/5 rounded-full blur-3xl group-hover:bg-blue-500/10 transition-colors">
                </div>
            </div>

            <div class="p-8 rounded-[2rem] bg-blue-600 dark:bg-blue-700 text-white flex flex-col justify-between group">
                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-md mb-6">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-2">Modern Stack</h3>
                    <p class="text-blue-100 text-sm leading-relaxed">Dibangun dengan Laravel & Tailwind CSS untuk performa
                        yang ringan dan responsif di segala perangkat.</p>
                </div>
            </div>

            <div
                class="p-8 rounded-[2rem] border border-slate-200 dark:border-slate-800 flex flex-col justify-between hover:bg-slate-50 dark:hover:bg-slate-900 transition-colors">
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold dark:text-white mb-2">Privasi Tanpa Celah</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm">Data Anda diproses di sisi klien. Kami tidak
                        pernah tahu apa yang Anda tulis.</p>
                </div>
            </div>

            <div
                class="md:col-span-2 p-8 md:p-12 rounded-[2rem] border border-slate-200 dark:border-slate-800 flex flex-col md:flex-row items-center gap-8">
                <div
                    class="w-32 h-32 rounded-3xl bg-gradient-to-br from-slate-200 to-slate-100 dark:from-slate-800 dark:to-slate-700 flex-shrink-0 overflow-hidden border-4 border-white dark:border-slate-900 shadow-xl">
                    <div class="w-full h-full flex items-center justify-center text-slate-400 font-bold">EH</div>
                </div>
                <div>
                    <h3 class="text-2xl font-bold dark:text-white mb-2">Cerita Dibalik Layar</h3>
                    <p class="text-slate-600 dark:text-slate-400 leading-relaxed mb-4">
                        Dikembangkan di Tegal, Jawa Tengah, oleh seorang developer yang percaya bahwa teknologi harusnya
                        memudahkan, bukan mempersulit. GaweDokumen merupakan bentuk pengabdian saya yang memiliki ilmu
                        teknologi untuk indonesia lebih maju.
                    </p>
                    <div class="flex gap-4">
                        {{-- <a href="#"
                            class="text-blue-600 dark:text-blue-400 font-bold text-sm hover:underline">Portfolio</a>
                        <a href="#"
                            class="text-blue-600 dark:text-blue-400 font-bold text-sm hover:underline">LinkedIn</a> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-6 mt-24">
            <div
                class="relative p-1 rounded-[2.5rem] bg-gradient-to-r from-blue-600 to-cyan-500 overflow-hidden shadow-2xl shadow-blue-500/20">
                <div
                    class="bg-white dark:bg-slate-950 rounded-[2.3rem] p-10 flex flex-col md:flex-row items-center justify-between text-center md:text-left">
                    <div>
                        <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-2">Butuh Bantuan?</h2>
                        <p class="text-slate-500 dark:text-slate-400">Hubungi tim kami jika ada saran atau kerjasama.</p>
                    </div>
                    <a href="mailto:support@gawedokumen.com"
                        class="mt-8 md:mt-0 px-8 py-4 bg-blue-600 text-white rounded-2xl font-bold hover:scale-105 transition-transform shadow-lg shadow-blue-600/30">
                        Email Kami Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
