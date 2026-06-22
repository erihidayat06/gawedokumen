<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', 'Admin Gawe Dokumen - Solusi Dokumen Digital Gratis')</title>

    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    @vite(['resources/js/app.js'])
    {{-- Hapus app.css jika itu merusak tampilan Bootstrap SB Admin 2 --}}

    <style>
        /* Styling khusus untuk brand logo */
        .sidebar-brand {
            transition: all 0.3s;
        }

        .brand-logo-box {
            transition: transform 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 123, 255, 0.3);
            /* Shadow biru ala Tailwind */
        }

        /* Efek hover rotate 12 derajat */
        .sidebar-brand:hover .brand-logo-box {
            transform: rotate(12deg);
        }

        .sidebar-brand-text span {
            font-family: 'Nunito', sans-serif;
            /* Font standar SB Admin 2 */
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('admin.layouts.sidebar')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                @include('admin.layouts.header')
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            @include('admin.layouts.footer')
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous">
    </script>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function updateLiveAgeCounter() {
                // Set tanggal awal: 17 April 2026 jam 00:00:00
                const startDate = new Date("2026-04-17T00:00:00");
                const endDate = new Date(); // Waktu saat ini (berjalan mengikuti jam komputer user)

                // Jika waktu saat ini belum melewati tanggal awal
                if (endDate < startDate) {
                    document.getElementById("age-display").innerText = "Belum Dimulai";
                    return;
                }

                // 1. Hitung Selisih Kalender (Tahun, Bulan, Hari)
                let years = endDate.getFullYear() - startDate.getFullYear();
                let months = endDate.getMonth() - startDate.getMonth();
                let days = endDate.getDate() - startDate.getDate();

                if (days < 0) {
                    months--;
                    const previousMonth = new Date(endDate.getFullYear(), endDate.getMonth(), 0);
                    days += previousMonth.getDate();
                }

                if (months < 0) {
                    years--;
                    months += 12;
                }

                // 2. Hitung Sisa Waktu Aktif Hari Ini (Jam, Menit, Detik)
                let hours = endDate.getHours();
                let minutes = endDate.getMinutes();
                let seconds = endDate.getSeconds();

                // Format angka agar selalu 2 digit (misal: 05 menit, 09 detik)
                hours = String(hours).padStart(2, '0');
                minutes = String(minutes).padStart(2, '0');
                seconds = String(seconds).padStart(2, '0');

                // 3. Rangkai Teks Output
                let outputText = "";
                if (years > 0) outputText += `${years} Thn `;
                if (months > 0 || years > 0) outputText += `${months} Bln `;
                outputText += `${days} Hari - ${hours}:${minutes}:${seconds}`;

                // Inject hasil ke element HTML
                document.getElementById("age-display").innerText = outputText;
            }

            // Jalankan fungsi pertama kali saat page load
            updateLiveAgeCounter();

            // Paksa fungsi berjalan otomatis setiap 1 detik (1000 milidetik)
            setInterval(updateLiveAgeCounter, 1000);
        });
    </script>

</body>

</html>
