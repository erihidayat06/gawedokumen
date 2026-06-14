<div class=" min-h-screen pb-20">
    {{-- Header --}}
    <div class="pt-20 pb-10 px-4 text-center">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight mb-3">
            Syarat & <span class="text-blue-600">Ketentuan</span>
        </h1>
        <p class="text-sm sm:text-base text-slate-500 dark:text-slate-400 max-w-2xl mx-auto px-4">
            Berlaku mulai: 10 Juni 2026. <br class="hidden sm:block">
            Harap baca ketentuan penggunaan layanan GaweDokumen dengan seksama.
        </p>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        {{-- Intro Box --}}
        <div
            class="mb-10 p-6 sm:p-8 rounded-3xl bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-800 text-center">
            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400 leading-relaxed">
                Dengan mengakses dan menggunakan <strong>GaweDokumen</strong>, Anda dianggap telah membaca, memahami,
                dan menyetujui seluruh ketentuan yang berlaku di bawah ini. Pengumpulan dan penggunaan data pribadi Anda
                diatur dalam <a href="/privacy" class="text-blue-600 underline font-bold">Kebijakan Privasi</a> kami.
            </p>
        </div>

        {{-- Section List --}}
        <div class="space-y-8 sm:space-y-12 prose prose-slate dark:prose-invert max-w-none">

            @php
                $terms = [
                    [
                        't' => 'Penggunaan Layanan',
                        'd' =>
                            'GaweDokumen menyediakan alat untuk pembuatan dokumen otomatis. Anda dilarang menggunakan layanan ini untuk membuat dokumen palsu, melakukan penipuan, atau melanggar hukum yang berlaku di wilayah Republik Indonesia.',
                    ],
                    [
                        't' => 'Akurasi Dokumen',
                        'd' =>
                            'Kami berusaha memberikan template yang sesuai dengan standar umum. Namun, GaweDokumen tidak bertanggung jawab atas kesalahan ketik, kesalahan format, atau penolakan dokumen oleh pihak ketiga. Anda bertanggung jawab penuh untuk memeriksa kembali hasil dokumen sebelum digunakan.',
                    ],
                    [
                        't' => 'Akun & Layanan Berbayar',
                        'd' =>
                            'Pengguna bertanggung jawab atas kerahasiaan kredensial akun mereka. Jika Anda menggunakan layanan berbayar, Anda setuju untuk melakukan pembayaran sesuai dengan harga yang tertera. Semua pembayaran bersifat final (non-refundable), kecuali ditentukan lain dalam kebijakan pengembalian dana kami.',
                    ],
                    [
                        't' => 'Penyimpanan Data Cloud',
                        'd' =>
                            'Fitur penyimpanan Cloud disediakan "sebagaimana adanya". Meskipun kami melakukan upaya terbaik untuk menjaga keamanan dan ketersediaan data, kami tidak menjamin ketersediaan data 100% atau bebas dari kerusakan teknis. Kami menyarankan Anda untuk tetap menyimpan salinan cadangan dokumen penting secara mandiri.',
                    ],
                    [
                        't' => 'Kepemilikan Konten',
                        'd' =>
                            'Segala data yang Anda masukkan adalah milik Anda sepenuhnya. GaweDokumen tidak memiliki hak atas informasi pribadi yang Anda input. Namun, desain template, database, dan kode program website adalah properti intelektual milik GaweDokumen.',
                    ],
                    [
                        't' => 'Batasan Tanggung Jawab',
                        'd' =>
                            'GaweDokumen tidak bertanggung jawab atas segala kerugian material maupun imaterial yang timbul akibat penggunaan layanan ini, termasuk namun tidak terbatas pada kegagalan mendapatkan pekerjaan, kehilangan data Cloud, atau kesalahan administrasi lainnya.',
                    ],
                    [
                        't' => 'Perubahan Ketentuan',
                        'd' =>
                            'Kami berhak mengubah syarat dan ketentuan ini sewaktu-waktu tanpa pemberitahuan sebelumnya. Penggunaan berkelanjutan atas situs ini setelah perubahan dianggap sebagai persetujuan Anda terhadap ketentuan yang baru.',
                    ],
                ];
            @endphp

            @foreach ($terms as $index => $term)
                <section>
                    <h3 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-3">
                        <span
                            class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg bg-blue-600 text-white text-sm font-bold">
                            {{ $index + 1 }}
                        </span>
                        {{ $term['t'] }}
                    </h3>

                    @if ($index === 5)
                        {{-- Khusus untuk Batasan Tanggung Jawab --}}
                        <div
                            class="mt-4 ml-0 sm:ml-11 p-5 bg-red-50 dark:bg-red-900/10 border-l-4 border-red-500 rounded-r-xl">
                            <p class="text-red-700 dark:text-red-400 text-sm sm:text-base leading-relaxed m-0">
                                {{ $term['d'] }}
                            </p>
                        </div>
                    @else
                        <p
                            class="text-sm sm:text-base text-slate-600 dark:text-slate-400 mt-3 ml-0 sm:ml-11 leading-relaxed">
                            {{ $term['d'] }}
                        </p>
                    @endif
                </section>
            @endforeach

            {{-- Footer Contact --}}
            <div class="pt-8 border-t border-slate-200 dark:border-slate-800 text-center">
                <p class="text-slate-500 dark:text-slate-400 text-sm">
                    Pertanyaan mengenai Ketentuan Layanan? <br>
                    <a href="mailto:support@gawedokumen.com" class="text-blue-600 font-bold hover:underline">Hubungi Tim
                        Support</a>
                </p>
            </div>
        </div>
    </div>
</div>
