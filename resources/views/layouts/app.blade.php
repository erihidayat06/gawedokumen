<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Meta Title Dinamis --}}
    <title>@yield('title', 'Gawe Dokumen - Solusi Dokumen Digital Gratis')</title>

    <link rel="icon" type="image/png" href="{{ asset('img/icon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/icon.png') }}">

    <link rel="stylesheet" href="/css/icon.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script>
        // Cek localStorage atau preferensi sistem browser
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

    @if (app()->environment('production') && config('services.google.analytics_id'))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google.analytics_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', "{{ config('services.google.analytics_id') }}");
        </script>
    @endif

    {{-- Google AdSense (Hanya aktif di Production & Jika Publisher ID diisi) --}}
    @if (app()->environment('production') && config('services.google.adsense_client_id'))
        <script async
            src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{ config('services.google.adsense_client_id') }}"
            crossorigin="anonymous"></script>
    @endif

    {{-- Meta Description Dinamis --}}
    <meta name="description" content="@yield('meta_description', 'Bikin surat lamaran, label, dan dokumen administrasi otomatis dalam hitungan menit.')">

    {{-- Open Graph untuk Facebook/WhatsApp agar gambar muncul saat di-share --}}
    <meta property="og:title" content="@yield('title', 'Gawe Dokumen')">
    <meta property="og:description" content="@yield('meta_description')">
    <meta property="og:image" content="@yield('og_image', asset('/img/default-og-image.jpg'))">
    <meta property="og:type" content="article">

    <script>
        // Cek preferensi perangkat atau localStorage secepat mungkin
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-100 dark:bg-slate-950">

    @include('layouts.navbar')

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    @include('layouts.footer')

    @stack('scripts')

    <script defer src="https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const themeToggleBtn = document.getElementById('theme-toggle');
            const darkIcon = document.getElementById('theme-toggle-dark-icon');
            const lightIcon = document.getElementById('theme-toggle-light-icon');

            // Fungsi sinkronisasi ikon dengan state class 'dark'
            const updateIcons = () => {
                const isDark = document.documentElement.classList.contains('dark');
                lightIcon.classList.toggle('hidden', !isDark);
                darkIcon.classList.toggle('hidden', isDark);
            };

            // Jalankan sekali saat halaman siap untuk menyesuaikan ikon
            updateIcons();

            // Event listener klik
            themeToggleBtn.addEventListener('click', () => {
                document.documentElement.classList.toggle('dark');
                const isDark = document.documentElement.classList.contains('dark');

                // Simpan pilihan user agar menetap (override preferensi perangkat)
                localStorage.theme = isDark ? 'dark' : 'light';

                updateIcons();
            });
        });
    </script>
</body>

</html>
