document.addEventListener('DOMContentLoaded', () => {
    const elem = document.getElementById('panzoom-element');
    const parent = elem.parentElement;

    if (typeof Panzoom !== 'undefined') {
        // 1. Tentukan Koordinat Berdasarkan Layar
        const isDesktop = window.innerWidth >= 768;

        // Angka dari temuan kamu (Desktop)
        const desktopScale = 0.9;
        const desktopX = 0;
        const desktopY = 0;

        // Angka perkiraan untuk Mobile (Silakan sesuaikan jika sudah nemu yang pas)
        const mobileScale = 0.4;
        const mobileY = -750;

        const panzoom = Panzoom(elem, {
            maxScale: 5,
            minScale: 0.1,
            canvas: true,
            startScale: isDesktop ? desktopScale : mobileScale,
            cursor: 'move',
        });

        // 2. Fungsi Reset ke Posisi Presisi
        const setPresisi = () => {
            if (window.innerWidth >= 768) {
                // Pakai angka desktop kamu
                panzoom.zoom(desktopScale);
                panzoom.pan(desktopX, desktopY, {
                    force: true
                });
            } else {
                // Pakai angka mobile
                panzoom.zoom(mobileScale);
                panzoom.pan(0, mobileY, {
                    force: true
                });
            }
        };

        // Jalankan otomatis saat buka
        setTimeout(setPresisi, 100);

        // Tombol Reset balik ke angka sakti ini
        document.getElementById('reset').addEventListener('click', () => {
            setPresisi();
        });

        parent.addEventListener('wheel', panzoom.zoomWithWheel);
        document.getElementById('zoom-in').addEventListener('click', panzoom.zoomIn);
        document.getElementById('zoom-out').addEventListener('click', panzoom.zoomOut);
    }
});

function setHariIni() {
    const inputTanggal = document.getElementById('tanggal');

    // 1. Ambil format YYYY-MM-DD untuk input date
    const hariIni = getTanggalInput(); // Fungsi ini sudah ada di kode sebelumnya

    // 2. Set nilai input
    inputTanggal.value = hariIni;

    // 3. Jalankan fungsi update agar preview di kertas berubah
    // Kita panggil manual karena nilai yang diubah lewat JS tidak memicu event 'oninput'
    myFunction('tanggal', 'tanggal-text', getTanggalIndo());
}

 function openTab(evt, tabName) {
    // 1. Ambil semua elemen dengan class "tab-content" dan sembunyikan (tambah class hidden)
    const contents = document.querySelectorAll('.tab-content');
    contents.forEach(content => content.classList.add('hidden'));

    // 2. Ambil semua tombol "tab-link" dan reset stylenya ke default
    const links = document.querySelectorAll('.tab-link');
    links.forEach(link => {
        link.classList.remove('border-blue-500', 'text-blue-600');
        link.classList.add('border-transparent', 'text-gray-500');
    });

    // 3. Tampilkan tab yang dipilih
    document.getElementById(tabName).classList.remove('hidden');

    // 4. Tambahkan styling aktif pada tombol yang diklik
    evt.currentTarget.classList.remove('border-transparent', 'text-gray-500');
    evt.currentTarget.classList.add('border-blue-500', 'text-blue-600');
}
