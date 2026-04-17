<footer class="bg-white dark:bg-slate-950 border-t border-slate-200 dark:border-slate-800 mt-24">
    <div class="max-w-screen-xl mx-auto px-6 py-12 md:py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="col-span-1 md:col-span-2">
                <a href="/" class="flex items-center space-x-3 mb-4 group">
                    <div class="bg-blue-600 p-1.5 rounded-lg group-hover:rotate-6 transition-transform shadow-md">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <span class="self-center text-xl font-bold tracking-tight text-slate-800 dark:text-slate-100">
                        Gawe<span class="text-blue-600">Dokumen</span>
                    </span>
                </a>
                <p class="text-slate-500 dark:text-slate-400 max-w-sm leading-relaxed text-sm">
                    Platform pembuatan dokumen instan yang aman dan efisien. Kami berkomitmen melindungi privasi Anda
                    dengan teknologi penyimpanan lokal.
                </p>
                <div class="flex space-x-4 mt-6">
                    <a href="#" class="text-slate-400 hover:text-blue-600 transition-colors"><i
                            class="fab fa-facebook"></i></a>
                    <a href="#" class="text-slate-400 hover:text-blue-600 transition-colors"><i
                            class="fab fa-instagram"></i></a>
                    <a href="#" class="text-slate-400 hover:text-blue-600 transition-colors"><i
                            class="fab fa-tiktok"></i></a>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-slate-900 dark:text-white uppercase tracking-wider mb-4">Layanan
                </h3>
                <ul class="space-y-3 text-sm">
                    <li><a href="/pekerja/surat-lamaran"
                            class="text-slate-600 dark:text-slate-400 hover:text-blue-600 transition-colors">Surat
                            Lamaran</a></li>
                    <li><a href="{{ route('tool.signature') }}"
                            class="text-slate-600 dark:text-slate-400 hover:text-blue-600 transition-colors">Tanda
                            Tangan di Gital</a></li>
                    <li><a href="/blog"
                            class="text-slate-600 dark:text-slate-400 hover:text-blue-600 transition-colors">Blog</a>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-slate-900 dark:text-white uppercase tracking-wider mb-4">Legalitas
                </h3>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('about') }}"
                            class="text-slate-600 dark:text-slate-400 hover:text-blue-600 transition-colors">Tentang
                            Kami</a></li>
                    <li><a href="{{ route('privacy') }}"
                            class="text-slate-600 dark:text-slate-400 hover:text-blue-600 transition-colors">Kebijakan
                            Privasi</a></li>
                    <li><a href="{{ route('terms') }}"
                            class="text-slate-600 dark:text-slate-400 hover:text-blue-600 transition-colors">Syarat &
                            Ketentuan</a></li>
                </ul>
            </div>
        </div>

        <div
            class="border-t border-slate-200 dark:border-slate-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-slate-500">
            <p>&copy; 2026 <strong>GaweDokumen</strong>. Dibuat dengan dedikasi untuk produktivitas Indonesia.</p>
            <p class="mt-4 md:mt-0 flex items-center">
                <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                Server Status: Online
            </p>
        </div>
    </div>
</footer>
