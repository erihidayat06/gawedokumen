@extends('layouts.app')

@section('content')
    <div class="bg-white dark:bg-slate-950 min-h-screen pb-20">
        <div class="pt-24 pb-12 px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight mb-4">
                Syarat & <span class="text-blue-600">Ketentuan</span>
            </h1>
            <p class="text-slate-500 dark:text-slate-400 max-w-2xl mx-auto">
                Berlaku mulai: 10 April 2026. <br>
                Harap baca ketentuan penggunaan layanan GaweDokumen dengan seksama.
            </p>
        </div>

        <div class="max-w-4xl mx-auto px-6">
            <div
                class="mb-12 p-8 rounded-[2rem] bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-800 text-center">
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed">
                    Dengan mengakses dan menggunakan <strong>GaweDokumen</strong>, Anda dianggap telah membaca, memahami,
                    dan menyetujui seluruh ketentuan yang berlaku di bawah ini.
                </p>
            </div>

            <div class="space-y-12 prose prose-slate dark:prose-invert max-w-none">

                <section>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-3">
                        <span
                            class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg bg-blue-600 text-white text-sm">1</span>
                        Penggunaan Layanan
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400 ml-11">
                        GaweDokumen menyediakan alat untuk pembuatan dokumen otomatis. Anda dilarang menggunakan layanan ini
                        untuk membuat dokumen palsu, menipu, atau melanggar hukum yang berlaku di wilayah Republik
                        Indonesia.
                    </p>
                </section>

                <section>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-3">
                        <span
                            class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg bg-blue-600 text-white text-sm">2</span>
                        Akurasi Dokumen
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400 ml-11">
                        Kami berusaha memberikan template yang sesuai dengan standar umum. Namun, GaweDokumen tidak
                        bertanggung jawab atas kesalahan ketik, kesalahan format, atau penolakan dokumen oleh pihak ketiga
                        (perusahaan/instansi). Kami menyarankan Anda untuk selalu memeriksa kembali hasil PDF sebelum
                        dicetak.
                    </p>
                </section>

                <section>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-3">
                        <span
                            class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg bg-blue-600 text-white text-sm">3</span>
                        Kepemilikan Konten
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400 ml-11">
                        Segala data yang Anda masukkan adalah milik Anda sepenuhnya. GaweDokumen tidak memiliki hak atas
                        informasi pribadi yang Anda input. Namun, desain template dan kode program website adalah properti
                        intelektual milik GaweDokumen.
                    </p>
                </section>

                <section>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-3">
                        <span
                            class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg bg-blue-600 text-white text-sm">4</span>
                        Batasan Tanggung Jawab
                    </h3>
                    <div class="ml-11 p-6 bg-red-50 dark:bg-red-900/10 border-l-4 border-red-500 rounded-r-xl">
                        <p class="text-red-700 dark:text-red-400 text-sm leading-relaxed">
                            GaweDokumen tidak bertanggung jawab atas segala kerugian material maupun imaterial yang timbul
                            akibat penggunaan layanan ini, termasuk namun tidak terbatas pada kegagalan mendapatkan
                            pekerjaan atau kesalahan administrasi lainnya.
                        </p>
                    </div>
                </section>

                <section>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-3">
                        <span
                            class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg bg-blue-600 text-white text-sm">5</span>
                        Perubahan Ketentuan
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400 ml-11">
                        Kami berhak mengubah syarat dan ketentuan ini sewaktu-waktu tanpa pemberitahuan sebelumnya.
                        Penggunaan berkelanjutan atas situs ini setelah perubahan dianggap sebagai persetujuan Anda.
                    </p>
                </section>

                <div class="pt-12 border-t border-slate-200 dark:border-slate-800 text-center">
                    <p class="text-slate-500 dark:text-slate-400 text-sm">
                        Pertanyaan mengenai Ketentuan Layanan? <br>
                        <a href="mailto:support@gawedokumen.com" class="text-blue-600 font-bold hover:underline">Hubungi Tim
                            Support</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
