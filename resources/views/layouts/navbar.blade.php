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

                <li class="w-full md:w-auto">
                    <a href="/" class="block py-2.5 px-4 text-blue-600 font-bold md:p-0">Beranda</a>
                </li>

                <li class="relative w-full md:w-auto">
                    <button
                        class="dropdown-button flex items-center justify-between w-full py-2.5 px-4 text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors md:p-0">
                        Pekerja
                        <svg class="w-4 h-4 ms-1 transition-transform duration-200" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <div
                        class="dropdown-content hidden w-full md:absolute md:w-44 mt-1 md:mt-4 bg-white dark:bg-slate-800 md:rounded-xl md:shadow-xl border-l-2 border-blue-600 md:border-l-0 md:border md:border-slate-200 md:dark:border-slate-700 overflow-hidden">
                        <ul class="py-1 text-sm">
                            <li>
                                <a href="{{ route('pekerja.surat.lamaran') }}"
                                    class="block px-6 md:px-4 py-2 text-slate-700 dark:text-slate-300 hover:bg-blue-50 dark:hover:bg-slate-700 hover:text-blue-600 transition-colors">
                                    Surat Lamaran Kerja
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pekerja.generate.cv') }}"
                                    class="block px-6 md:px-4 py-2 text-slate-700 dark:text-slate-300 hover:bg-blue-50 dark:hover:bg-slate-700 hover:text-blue-600 transition-colors">
                                    Membuat CV
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="relative w-full md:w-auto">
                    <button
                        class="dropdown-button flex items-center justify-between w-full py-2.5 px-4 text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors md:p-0">
                        Tools
                        <svg class="w-4 h-4 ms-1 transition-transform duration-200" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <div
                        class="dropdown-content hidden w-full md:absolute md:w-44 mt-1 md:mt-4 bg-white dark:bg-slate-800 md:rounded-xl md:shadow-xl border-l-2 border-blue-600 md:border-l-0 md:border md:border-slate-200 md:dark:border-slate-700 overflow-hidden">
                        <ul class="py-1 text-sm">
                            <li>
                                <a href="{{ route('tool.signature') }}"
                                    class="block px-6 md:px-4 py-2 text-slate-700 dark:text-slate-300 hover:bg-blue-50 dark:hover:bg-slate-700 hover:text-blue-600 transition-colors">
                                    Tanda Tangan Digital
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('tool.kompres.pdf.index') }}"
                                    class="block px-6 md:px-4 py-2 text-slate-700 dark:text-slate-300 hover:bg-blue-50 dark:hover:bg-slate-700 hover:text-blue-600 transition-colors">
                                    Kompres PDF
                                </a>
                            </li>
                        </ul>
                    </div>

                </li>


                <li class="w-full md:w-auto">
                    <a href="/blog"
                        class="block py-2.5 px-4 text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 md:p-0 transition-colors">
                        Blog
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<script>
    let lastScrollTop = 0;
    const navbar = document.getElementById('main-navbar');

    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop && scrollTop > 100) {
            // Jika scroll ke bawah dan sudah melewati 100px, sembunyikan navbar
            navbar.style.transform = 'translateY(-100%)';
        } else {
            // Jika scroll ke atas, munculkan kembali navbar
            navbar.style.transform = 'translateY(0)';
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // Untuk menangani mobile or negative scrolling
    }, false);
</script>

<script>
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownContent = document.getElementById('dropdownContent');

    document.addEventListener('DOMContentLoaded', () => {
        // --- 1. Navbar Scroll (Hide/Show) ---
        let lastScrollTop = 0;
        const navbar = document.getElementById('main-navbar');

        window.addEventListener('scroll', () => {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            if (scrollTop > lastScrollTop && scrollTop > 100) {
                navbar.style.transform = 'translateY(-100%)'; // Sembunyikan
            } else {
                navbar.style.transform = 'translateY(0)'; // Munculkan
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

                // Tutup dropdown lain yang sedang terbuka
                dropdownContents.forEach(content => {
                    if (content !== currentContent) content.classList.add('hidden');
                });

                // Toggle dropdown yang diklik
                currentContent.classList.toggle('hidden');
            });
        });

        // Tutup semuanya jika klik di luar navbar
        window.addEventListener('click', () => {
            dropdownContents.forEach(content => content.classList.add('hidden'));
            // Optional: tutup menu mobile juga saat klik luar
            if (window.innerWidth < 768) navbarMenu.classList.add('hidden');
        });
    });
</script>
