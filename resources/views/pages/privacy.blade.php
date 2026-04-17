@extends('layouts.app')

@section('content')
    <div class="bg-white dark:bg-slate-950 min-h-screen pb-20">
        <div class="pt-24 pb-12 px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight mb-4">
                Kebijakan <span class="text-blue-600">Privasi</span>
            </h1>
            <p class="text-slate-500 dark:text-slate-400 max-w-2xl mx-auto">
                Terakhir diperbarui: 10 April 2026. <br>
                Privasi Anda adalah prioritas utama kami. Kami membangun sistem yang menjaga data tetap di tangan Anda.
            </p>
        </div>

        <div class="max-w-4xl mx-auto px-6">
            <div class="mb-12 p-8 rounded-[2rem] bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-800">
                <div class="flex items-start gap-4">
                    <div class="bg-blue-600 p-2 rounded-lg mt-1">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Komitmen Tanpa Database</h2>
                        <p class="text-slate-600 dark:text-slate-400 leading-relaxed">
                            GaweDokumen dirancang dengan arsitektur <strong>Client-Side</strong>. Segala informasi yang Anda
                            masukkan (nama, alamat, hingga tanda tangan) diproses secara lokal di browser Anda. Kami tidak
                            menyimpan, mengumpulkan, atau membagikan data pribadi Anda ke server kami.
                        </p>
                    </div>
                </div>
            </div>

            <div class="space-y-12 prose prose-slate dark:prose-invert max-w-none">

                <section>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white">1. Informasi yang Kami Kumpulkan</h3>
                    <p class="text-slate-600 dark:text-slate-400">
                        Kami tidak mewajibkan pembuatan akun untuk menggunakan layanan GaweDokumen. Informasi yang Anda
                        masukkan dalam formulir generate dokumen hanya digunakan untuk mengisi template PDF secara real-time
                        yang hanya tersimpan pada browser anda, kami tidak menyimpan data anda ke dalam database kami yang
                        anda tulis di from GaweDokumen baik saat mengisi form atau saat anda mencetaknya
                        dan akan hilang secara otomatis saat Anda menutup tab browser atau membersihkan cache.
                    </p>
                </section>

                <section>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white">2. Cookies dan Teknologi Pelacakan</h3>
                    <p class="text-slate-600 dark:text-slate-400">
                        Kami menggunakan <em>Local Storage</em> browser untuk menyimpan preferensi ringan (seperti mode
                        gelap atau pilihan template terakhir) demi kenyamanan penggunaan Anda. Kami juga menggunakan layanan
                        pihak ketiga seperti Google Analytics untuk memahami trafik situs secara anonim agar kami bisa
                        mengetahui apa yang di perlukan oleh pengguna GaweDokumen dan sebagai evalusi kami agar GaweDokumen
                        ini bisa di kembangkan dengan lebih baik dan bisa membantu lebih banyak lagi pengguna.
                    </p>
                </section>

                <section>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white">3. Iklan Pihak Ketiga (Google AdSense)
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        Layanan kami didukung oleh iklan. Vendor pihak ketiga, termasuk Google, menggunakan cookie untuk
                        menayangkan iklan berdasarkan kunjungan pengguna sebelumnya ke situs web kami atau situs web lain.
                        Penggunaan cookie iklan oleh Google memungkinkan Google dan mitranya menayangkan iklan kepada
                        pengguna berdasarkan kunjungan mereka ke situs ini.
                    </p>
                    <div
                        class="p-4 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-50 rounded-xl text-sm border border-slate-200 dark:border-slate-800 italic">
                        Catatan: Anda dapat memilih untuk keluar dari iklan yang dipersonalisasi dengan mengunjungi <a
                            href="https://www.google.com/settings/ads" class="text-blue-600 underline">Setelan Iklan
                            Google</a>.
                    </div>
                </section>

                <section>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white">4. Keamanan Data</h3>
                    <p class="text-slate-600 dark:text-slate-400">
                        Meskipun data tidak disimpan di server kami, keamanan perangkat Anda adalah tanggung jawab Anda.
                        Kami menyarankan untuk selalu menggunakan koneksi internet yang aman saat mengunggah foto tanda
                        tangan atau data sensitif lainnya.
                    </p>
                </section>

                <section class="pt-8 border-t border-slate-200 dark:border-slate-800 text-center">
                    <p class="text-slate-500 dark:text-slate-400 text-sm">
                        Punya pertanyaan tentang kebijakan privasi kami? <br>
                        Hubungi kami melalui email di <a href="mailto:privacy@gawedokumen.com"
                            class="text-blue-600 font-bold">privacy@gawedokumen.com</a>
                    </p>
                </section>
            </div>
        </div>
    </div>
@endsection
