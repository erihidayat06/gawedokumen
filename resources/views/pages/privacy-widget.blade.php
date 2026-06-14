<div class=" min-h-screen pb-20">
    {{-- Header --}}
    <div class="pt-20 pb-10 px-4 text-center">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight mb-3">
            Kebijakan <span class="text-blue-600">Privasi</span>
        </h1>
        <p class="text-sm sm:text-base text-slate-500 dark:text-slate-400 max-w-2xl mx-auto">
            Terakhir diperbarui: 10 Juni 2026. <br class="hidden sm:block">
            Kami memberi Anda kendali penuh atas data Anda.
        </p>
    </div>

    {{-- Konten --}}
    <div class="max-w-3xl mx-auto px-4 sm:px-6 space-y-4">

        {{-- Komponen FAQ --}}
        @php
            $faqs = [
                [
                    't' => '1. Bagaimana cara GaweDokumen menyimpan data saya?',
                    'c' =>
                        'Kami menggunakan pendekatan <strong>Hybrid Storage</strong>. Secara default, data Anda diproses dan disimpan secara <em>Client-Side</em> (lokal di browser Anda) demi privasi maksimal. Anda tidak perlu akun untuk ini. Namun, jika Anda ingin data Anda tersedia di berbagai perangkat, Anda bisa memilih untuk mengaktifkan fitur <strong>"Simpan ke Cloud"</strong> dengan akun terdaftar.',
                ],
                [
                    't' => '2. Apa yang terjadi jika saya menyimpan data ke Cloud?',
                    'c' =>
                        'Jika Anda memilih untuk menyimpan data ke Cloud, informasi tersebut akan diunggah ke server kami yang terenkripsi agar bisa Anda akses kapan saja dan di mana saja. Data ini sepenuhnya milik Anda dan kami tidak akan pernah membagikannya tanpa izin. Anda tetap bisa menghapus data Cloud tersebut kapan pun melalui pengaturan akun Anda.',
                ],
                [
                    't' => '3. Bagaimana fitur Loker dan Job Alert bekerja?',
                    'c' =>
                        'Dengan mendaftarkan akun, Anda dapat menyimpan preferensi karier. Kami hanya menyimpan informasi Nama, Email, dan preferensi loker yang Anda simpan. Kami akan mengirimkan <em>Job Alert</em> yang relevan agar Anda tetap update dengan peluang kerja terbaru. Anda dapat berhenti berlangganan kapan saja di pengaturan email.',
                ],
                [
                    't' => '4. Apakah pembayaran di GaweDokumen aman?',
                    'c' =>
                        'Ya. Kami bekerja sama dengan penyedia gerbang pembayaran terpercaya yang memenuhi standar keamanan industri (PCI-DSS). Kami tidak pernah menyimpan nomor kartu kredit atau detail perbankan Anda di server kami.',
                ],
                [
                    't' => '5. Mengapa ada iklan di situs ini?',
                    'c' =>
                        'Iklan membantu kami menjaga layanan GaweDokumen tetap gratis. Kami menggunakan layanan Google AdSense. Anda selalu bisa mengontrol iklan yang ditampilkan melalui <a href="https://www.google.com/settings/ads" class="text-blue-600 underline">Setelan Iklan Google</a>.',
                ],
                [
                    't' => '6. Apa hak saya terhadap data yang saya simpan?',
                    'c' =>
                        'Anda memiliki kendali penuh. Anda berhak meminta akses, perbaikan, atau penghapusan permanen atas akun dan data yang Anda simpan di cloud kami kapan saja. Silakan hubungi kami melalui email untuk memproses permintaan tersebut.',
                ],
                [
                    't' => '7. Apakah kebijakan ini bisa berubah?',
                    'c' =>
                        'Ya, kami mungkin memperbarui kebijakan ini dari waktu ke waktu untuk menyesuaikan dengan fitur baru atau perubahan regulasi. Perubahan signifikan akan kami informasikan melalui situs web atau email.',
                ],
            ];
        @endphp

        @foreach ($faqs as $index => $faq)
            <div x-data="{ open: {{ $index === 0 ? 'true' : 'false' }} }"
                class="rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 overflow-hidden">
                <button @click="open = !open"
                    class="w-full p-5 text-left flex justify-between items-center focus:outline-none">
                    <h3 class="text-base sm:text-lg font-bold text-slate-900 dark:text-white leading-snug">
                        {!! $faq['t'] !!}
                    </h3>
                    <span class="ml-2 text-slate-400" x-text="open ? '−' : '+'"></span>
                </button>
                <div x-show="open" x-collapse
                    class="px-5 pb-5 text-sm sm:text-base text-slate-600 dark:text-slate-400 leading-relaxed">
                    {!! $faq['c'] !!}
                </div>
            </div>
        @endforeach

        {{-- Footer Kontak --}}
        <div class="mt-12 text-center pb-10">
            <p class="text-slate-500 dark:text-slate-400 text-sm">
                Pertanyaan lebih lanjut? Email kami di <br class="sm:hidden">
                <a href="mailto:privacy@gawedokumen.com"
                    class="text-blue-600 font-bold hover:underline">privacy@gawedokumen.com</a>
            </p>
        </div>
    </div>
</div>
