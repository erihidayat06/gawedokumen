<nav id="main-navbar"
    class="fixed w-full z-50 top-0 start-0 border-b border-slate-200/50 dark:border-white/10 bg-white/95 dark:bg-slate-900/95 backdrop-blur-md shadow-sm transition-transform duration-300">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 group">
            <div
                class="bg-blue-600 p-2 rounded-lg group-hover:rotate-12 transition-transform shadow-lg shadow-blue-500/30">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
            </div>
            <span
                class="self-center text-2xl font-bold whitespace-nowrap tracking-tight text-slate-800 dark:text-slate-100">
                Gawe<span class="text-blue-600">Dokumen</span>
            </span>
        </a>

        <button id="menu-toggle" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-slate-500 rounded-lg md:hidden hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>

        <div class="hidden w-full md:block md:w-auto mt-4 md:mt-0" id="navbar-menu">
            <ul
                class="flex flex-col p-2 md:p-0 font-medium border border-slate-100 dark:border-slate-800 rounded-2xl bg-slate-50 dark:bg-slate-800/50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-transparent md:dark:bg-transparent items-center">

                {{-- Menu Beranda --}}
                <li class="w-full md:w-auto">
                    <a href="/"
                        class="block py-2.5 px-4 md:p-0 transition-colors {{ request()->is('/') ? 'text-blue-600 font-bold dark:text-blue-400' : 'text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400' }}">
                        Beranda
                    </a>
                </li>

                {{-- Dropdown Pekerja --}}
                <li class="relative w-full md:w-auto">
                    <button
                        class="dropdown-button flex items-center justify-between w-full py-2.5 px-4 md:p-0 transition-colors {{ request()->is('kategori/pekerja*') || request()->routeIs('pekerja.*') ? 'text-blue-600 font-bold dark:text-blue-400' : 'text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400' }}">
                        Pekerja
                        <svg class="w-4 h-4 ms-1 transition-transform duration-200" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <div
                        class="dropdown-content hidden w-full md:absolute md:w-56 mt-1 md:mt-4 bg-white dark:bg-slate-800 md:rounded-xl md:shadow-xl border-l-2 border-blue-600 md:border-l-0 md:border md:border-slate-200 md:dark:border-slate-700 overflow-hidden z-50">
                        <ul class="py-1 text-sm">
                            <li>
                                <a href="/kategori/pekerja"
                                    class="block px-6 md:px-4 py-2 transition-colors {{ request()->is('kategori/pekerja') ? 'bg-blue-50 text-blue-600 font-semibold dark:bg-slate-700/60 dark:text-blue-400' : 'text-slate-700 dark:text-slate-300 hover:bg-blue-50 dark:hover:bg-slate-700 hover:text-blue-600' }}">
                                    Semua Surat
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pekerja.surat.lamaran') }}"
                                    class="block px-6 md:px-4 py-2 transition-colors {{ request()->routeIs('pekerja.surat.lamaran') ? 'bg-blue-50 text-blue-600 font-semibold dark:bg-slate-700/60 dark:text-blue-400' : 'text-slate-700 dark:text-slate-300 hover:bg-blue-50 dark:hover:bg-slate-700 hover:text-blue-600' }}">
                                    Surat Lamaran Kerja
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pekerja.generate.cv') }}"
                                    class="block px-6 md:px-4 py-2 transition-colors {{ request()->routeIs('pekerja.generate.cv') ? 'bg-blue-50 text-blue-600 font-semibold dark:bg-slate-700/60 dark:text-blue-400' : 'text-slate-700 dark:text-slate-300 hover:bg-blue-50 dark:hover:bg-slate-700 hover:text-blue-600' }}">
                                    Membuat CV
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pekerja.kirim.lamaran.email') }}"
                                    class="block px-6 md:px-4 py-2 transition-colors {{ request()->routeIs('pekerja.kirim.lamaran.email') ? 'bg-blue-50 text-blue-600 font-semibold dark:bg-slate-700/60 dark:text-blue-400' : 'text-slate-700 dark:text-slate-300 hover:bg-blue-50 dark:hover:bg-slate-700 hover:text-blue-600' }}">
                                    Kirim ke Email HRD (Otomatis)
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pekerja.surat.resign') }}"
                                    class="block px-6 md:px-4 py-2 transition-colors {{ request()->routeIs('pekerja.surat.resign') ? 'bg-blue-50 text-blue-600 font-semibold dark:bg-slate-700/60 dark:text-blue-400' : 'text-slate-700 dark:text-slate-300 hover:bg-blue-50 dark:hover:bg-slate-700 hover:text-blue-600' }}">
                                    Surat Resign
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pekerja.surat.paklaring') }}"
                                    class="block px-6 md:px-4 py-2 transition-colors {{ request()->routeIs('pekerja.surat.paklaring') ? 'bg-blue-50 text-blue-600 font-semibold dark:bg-slate-700/60 dark:text-blue-400' : 'text-slate-700 dark:text-slate-300 hover:bg-blue-50 dark:hover:bg-slate-700 hover:text-blue-600' }}">
                                    Surat Paklaring
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pekerja.portofolio.index') }}"
                                    class="block px-6 md:px-4 py-2 transition-colors {{ request()->routeIs('pekerja.portofolio.index') ? 'bg-blue-50 text-blue-600 font-semibold dark:bg-slate-700/60 dark:text-blue-400' : 'text-slate-700 dark:text-slate-300 hover:bg-blue-50 dark:hover:bg-slate-700 hover:text-blue-600' }}">
                                    Pertofolio
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Dropdown Tools --}}
                <li class="relative w-full md:w-auto">
                    <button
                        class="dropdown-button flex items-center justify-between w-full py-2.5 px-4 md:p-0 transition-colors {{ request()->routeIs('tool.*') ? 'text-blue-600 font-bold dark:text-blue-400' : 'text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400' }}">
                        Tools
                        <svg class="w-4 h-4 ms-1 transition-transform duration-200" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <div
                        class="dropdown-content hidden w-full md:absolute md:w-52 mt-1 md:mt-4 bg-white dark:bg-slate-800 md:rounded-xl md:shadow-xl border-l-2 border-blue-600 md:border-l-0 md:border md:border-slate-200 md:dark:border-slate-700 overflow-hidden z-50">
                        <ul class="py-1 text-sm">
                            <li>
                                <a href="{{ route('tool.signature') }}"
                                    class="block px-6 md:px-4 py-2 transition-colors {{ request()->routeIs('tool.signature') ? 'bg-blue-50 text-blue-600 font-semibold dark:bg-slate-700/60 dark:text-blue-400' : 'text-slate-700 dark:text-slate-300 hover:bg-blue-50 dark:hover:bg-slate-700 hover:text-blue-600' }}">
                                    Tanda Tangan Digital
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('tool.kompres.pdf.index') }}"
                                    class="block px-6 md:px-4 py-2 transition-colors {{ request()->routeIs('tool.kompres.pdf.*') ? 'bg-blue-50 text-blue-600 font-semibold dark:bg-slate-700/60 dark:text-blue-400' : 'text-slate-700 dark:text-slate-300 hover:bg-blue-50 dark:hover:bg-slate-700 hover:text-blue-600' }}">
                                    Kompres PDF
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('tool.kompres.gambar.index') }}"
                                    class="block px-6 md:px-4 py-2 transition-colors {{ request()->routeIs('tool.kompres.gambar.*') ? 'bg-blue-50 text-blue-600 font-semibold dark:bg-slate-700/60 dark:text-blue-400' : 'text-slate-700 dark:text-slate-300 hover:bg-blue-50 dark:hover:bg-slate-700 hover:text-blue-600' }}">
                                    Kompres Gambar
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('tool.pdf.merge.index') }}"
                                    class="block px-6 md:px-4 py-2 transition-colors {{ request()->routeIs('tool.pdf.merge.*') ? 'bg-blue-50 text-blue-600 font-semibold dark:bg-slate-700/60 dark:text-blue-400' : 'text-slate-700 dark:text-slate-300 hover:bg-blue-50 dark:hover:bg-slate-700 hover:text-blue-600' }}">
                                    Gabung PDF
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Menu Loker --}}
                <li class="w-full md:w-auto">
                    <a href="{{ route('loker.index') }}"
                        class="block py-2.5 px-4 md:p-0 transition-colors {{ request()->routeIs('loker.*') ? 'text-blue-600 font-bold dark:text-blue-400' : 'text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400' }}">
                        Loker
                    </a>
                </li>

                {{-- Menu Blog --}}
                <li class="w-full md:w-auto">
                    <a href="/blog"
                        class="block py-2.5 px-4 md:p-0 transition-colors {{ request()->is('blog*') ? 'text-blue-600 font-bold dark:text-blue-400' : 'text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400' }}">
                        Blog
                    </a>
                </li>
                @auth
                    <li class="relative w-full md:w-auto md:ml-4">
                        <button type="button"
                            class="dropdown-button flex items-center justify-between w-full py-2.5 px-4 md:p-0 text-slate-700 dark:text-slate-300 hover:text-blue-600 transition-colors">
                            <span class="truncate max-w-[120px]">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4 ms-1 transition-transform duration-200" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        {{-- Dropdown Content --}}
                        {{-- Kita tambahkan 'md:left-auto md:right-0' agar di desktop menempel kanan, di mobile mengikuti alur --}}
                        <div
                            class="dropdown-content hidden w-full md:absolute md:right-0 mt-2 md:w-48 bg-white dark:bg-slate-800 rounded-xl shadow-xl border border-slate-200 dark:border-slate-700 z-[9999]">
                            <ul class="py-1 text-sm">
                                <li>
                                    <a href="{{ route('dashboard.index') }}"
                                        class="block px-4 py-2 text-slate-700 dark:text-slate-300 hover:bg-blue-50 dark:hover:bg-slate-700 hover:text-blue-600">
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="w-full text-left px-4 py-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-slate-700">
                                            Keluar
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                @else
                    {{-- Container untuk Guest (Login/Daftar) --}}
                    <li class="w-full md:w-auto mt-4 md:mt-0 md:ml-4 flex flex-col md:flex-row gap-2">
                        <a href="{{ route('login') }}"
                            class="text-center px-5 py-2 text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-blue-600 transition-colors">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}"
                            class="text-center px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-lg shadow-blue-600/20 transition-all">
                            Daftar
                        </a>
                    </li>
                @endauth
                {{-- Tombol Dark Mode Toggle --}}
                <li class="w-full md:w-auto">
                    <button id="theme-toggle" type="button"
                        class="p-2 text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg transition-colors">
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 7a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.464 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707z">
                            </path>
                        </svg>
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Pastikan tidak ada elemen yang memotong dropdown */
    .nav-container {
        overflow: visible !important;
    }

    .dropdown-content {
        /* Mencegah pemotongan di layar kecil */
        max-height: 90vh;
        overflow-y: auto;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // --- 1. Navbar Scroll (Hide/Show) ---
        let lastScrollTop = 0;
        const navbar = document.getElementById('main-navbar');

        window.addEventListener('scroll', () => {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            if (scrollTop > lastScrollTop && scrollTop > 100) {
                navbar.style.transform = 'translateY(-100%)'; // Sembunyikan ke atas
            } else {
                navbar.style.transform = 'translateY(0)'; // Munculkan kembali
            }
            lastScrollTop = Math.max(0, scrollTop);
        });

        // --- 2. Mobile Menu Toggle ---
        const menuToggle = document.getElementById('menu-toggle');
        const navbarMenu = document.getElementById('navbar-menu');

        menuToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            navbarMenu.classList.toggle('hidden');
        });

        // --- 3. Multi-Dropdown Logic ---
        const dropdownButtons = document.querySelectorAll('.dropdown-button');
        const dropdownContents = document.querySelectorAll('.dropdown-content');

        dropdownButtons.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const currentContent = btn.nextElementSibling;
                const arrowIcon = btn.querySelector('svg');

                // Tutup dropdown lain yang sedang terbuka & kembalikan rotasi panahnya
                dropdownButtons.forEach(otherBtn => {
                    if (otherBtn !== btn) {
                        otherBtn.nextElementSibling.classList.add('hidden');
                        const otherArrow = otherBtn.querySelector('svg');
                        if (otherArrow) otherArrow.style.transform = 'rotate(0deg)';
                    }
                });

                // Toggle dropdown yang diklik beserta animasi panahnya
                const isHidden = currentContent.classList.toggle('hidden');
                if (arrowIcon) {
                    arrowIcon.style.transform = isHidden ? 'rotate(0deg)' : 'rotate(180deg)';
                }
            });
        });

        // Tutup semua dropdown & menu mobile jika klik di sembarang tempat luar navbar
        window.addEventListener('click', () => {
            dropdownContents.forEach(content => content.classList.add('hidden'));
            dropdownButtons.forEach(btn => {
                const arrowIcon = btn.querySelector('svg');
                if (arrowIcon) arrowIcon.style.transform = 'rotate(0deg)';
            });
            if (window.innerWidth < 768) navbarMenu.classList.add('hidden');
        });
    });
</script>
