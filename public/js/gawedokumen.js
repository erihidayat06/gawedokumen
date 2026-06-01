document.addEventListener('DOMContentLoaded', () => {
    const elem = document.getElementById('panzoom-element');
    const parent = elem.parentElement;

    if (typeof Panzoom !== 'undefined') {
        const isDesktop = window.innerWidth >= 768;

        const desktopScale = 0.6;
        const desktopX = 0;
        const desktopY = -300;

        const mobileScale = 0.4;
        const mobileY = -750;

        const panzoom = Panzoom(elem, {
            maxScale: 5,
            minScale: 0.1,
            canvas: true,
            startScale: isDesktop ? desktopScale : mobileScale,
            cursor: 'move',
        });

        const setPresisi = () => {
            if (window.innerWidth >= 768) {
                panzoom.zoom(desktopScale);
                panzoom.pan(desktopX, desktopY, { force: true });
            } else {
                panzoom.zoom(mobileScale);
                panzoom.pan(0, mobileY, { force: true });
            }
        };

        setTimeout(setPresisi, 100);

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


function getTanggalIndo(dateString) {
    if (!dateString) return "";
    const date = new Date(dateString);

    // Cek apakah tanggal valid
    if (isNaN(date.getTime())) return dateString;

    const options = { day: 'numeric', month: 'long', year: 'numeric' };
    return date.toLocaleDateString('id-ID', options);
}
