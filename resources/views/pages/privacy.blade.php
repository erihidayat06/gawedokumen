@extends('layouts.app')

@section('content')
    <div class="bg-white dark:bg-slate-950 min-h-screen pb-20">
        <div class="pt-24 pb-12 px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight mb-4">
                Kebijakan <span class="text-blue-600">Privasi</span>
            </h1>
            <p class="text-slate-500 dark:text-slate-400 max-w-2xl mx-auto">
                Terakhir diperbarui: 10 Juni 2026. <br>
                Kami memberi Anda kendali penuh atas data Anda.
            </p>
        </div>

        <div class="max-w-3xl mx-auto px-6 space-y-4">

            <div x-data="{ open: true }"
                class="rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 overflow-hidden">
                <button @click="open = !open"
                    class="w-full p-6 text-left flex justify-between items-center focus:outline-none">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">1. Bagaimana cara GaweDokumen menyimpan
                        data saya?</h3>
                </button>
                <div x-show="open" x-collapse class="px-6 pb-6 text-slate-600 dark:text-slate-400">
                    Kami menggunakan pendekatan <strong>Hybrid Storage</strong>. Secara default, data Anda diproses dan
                    disimpan secara <em>Client-Side</em> (lokal di browser Anda) demi privasi maksimal. Anda tidak perlu
                    akun untuk ini. Namun, jika Anda ingin data Anda tersedia di berbagai perangkat, Anda bisa memilih untuk
                    mengaktifkan fitur <strong>"Simpan ke Cloud"</strong> dengan akun terdaftar.
                </div>
            </div>

            <div x-data="{ open: false }"
                class="rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 overflow-hidden">
                <button @click="open = !open"
                    class="w-full p-6 text-left flex justify-between items-center focus:outline-none">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">2. Apa yang terjadi jika saya menyimpan
                        data ke Cloud?</h3>
                </button>
                <div x-show="open" x-collapse class="px-6 pb-6 text-slate-600 dark:text-slate-400">
                    Jika Anda memilih untuk menyimpan data ke Cloud, informasi tersebut akan diunggah ke server kami yang
                    terenkripsi agar bisa Anda akses kapan saja dan di mana saja. Data ini sepenuhnya milik Anda dan kami
                    tidak akan pernah membagikannya tanpa izin. Anda tetap bisa menghapus data Cloud tersebut kapan pun
                    melalui pengaturan akun Anda.
                </div>
            </div>

            <div x-data="{ open: false }"
                class="rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 overflow-hidden">
                <button @click="open = !open"
                    class="w-full p-6 text-left flex justify-between items-center focus:outline-none">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">3. Bagaimana fitur Loker dan Job Alert
                        bekerja?</h3>
                </button>
                <div x-show="open" x-collapse class="px-6 pb-6 text-slate-600 dark:text-slate-400">
                    Dengan mendaftarkan akun, Anda dapat menyimpan preferensi karier. Kami hanya menyimpan informasi Nama,
                    Email, dan preferensi loker yang Anda simpan. Kami akan mengirimkan <em>Job Alert</em> yang relevan agar
                    Anda tetap update dengan peluang kerja terbaru. Anda dapat berhenti berlangganan kapan saja di
                    pengaturan email.
                </div>
            </div>

            <div x-data="{ open: false }"
                class="rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 overflow-hidden">
                <button @click="open = !open"
                    class="w-full p-6 text-left flex justify-between items-center focus:outline-none">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">4. Apakah pembayaran di GaweDokumen aman?
                    </h3>
                </button>
                <div x-show="open" x-collapse class="px-6 pb-6 text-slate-600 dark:text-slate-400">
                    Ya. Kami bekerja sama dengan penyedia gerbang pembayaran terpercaya yang memenuhi standar keamanan
                    industri (PCI-DSS). Kami tidak pernah menyimpan nomor kartu kredit atau detail perbankan Anda di server
                    kami.
                </div>
            </div>

            <div x-data="{ open: false }"
                class="rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 overflow-hidden">
                <button @click="open = !open"
                    class="w-full p-6 text-left flex justify-between items-center focus:outline-none">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">5. Mengapa ada iklan di situs ini?</h3>
                </button>
                <div x-show="open" x-collapse class="px-6 pb-6 text-slate-600 dark:text-slate-400">
                    Iklan membantu kami menjaga layanan GaweDokumen tetap gratis. Kami menggunakan layanan Google AdSense.
                    Anda selalu bisa mengontrol iklan yang ditampilkan melalui <a href="https://www.google.com/settings/ads"
                        class="text-blue-600 underline">Setelan Iklan Google</a>.
                </div>
            </div>

            <div x-data="{ open: false }"
                class="rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 overflow-hidden">
                <button @click="open = !open"
                    class="w-full p-6 text-left flex justify-between items-center focus:outline-none">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">6. Apa hak saya terhadap data yang saya
                        simpan?</h3>
                </button>
                <div x-show="open" x-collapse class="px-6 pb-6 text-slate-600 dark:text-slate-400">
                    Anda memiliki kendali penuh. Anda berhak meminta akses, perbaikan, atau penghapusan permanen atas akun
                    dan data yang Anda simpan di cloud kami kapan saja. Silakan hubungi kami melalui email untuk memproses
                    permintaan tersebut.
                </div>
            </div>

            <div x-data="{ open: false }"
                class="rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 overflow-hidden">
                <button @click="open = !open"
                    class="w-full p-6 text-left flex justify-between items-center focus:outline-none">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">7. Apakah kebijakan ini bisa berubah?</h3>
                </button>
                <div x-show="open" x-collapse class="px-6 pb-6 text-slate-600 dark:text-slate-400">
                    Ya, kami mungkin memperbarui kebijakan ini dari waktu ke waktu untuk menyesuaikan dengan fitur baru atau
                    perubahan regulasi. Perubahan signifikan akan kami informasikan melalui situs web atau email.
                </div>
            </div>

            <div class="mt-12 text-center">
                <p class="text-slate-500 dark:text-slate-400 text-sm">
                    Pertanyaan lebih lanjut? Email kami di <a href="mailto:privacy@gawedokumen.com"
                        class="text-blue-600 font-bold">privacy@gawedokumen.com</a>
                </p>
            </div>
        </div>
    </div>
@endsection
