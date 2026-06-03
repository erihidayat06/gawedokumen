@extends('admin.layouts.main')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        .paper-container {
            position: relative;
            width: 100%;
            max-width: 800px;
            margin: 40px auto;
        }

        .btn-download {
            margin-bottom: 20px;
            padding: 12px 25px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .folio-paper {
            background-color: #fdfdfd;
            border: 1px solid #ddd;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            padding-top: 40px;
            min-height: 1060px;
            box-sizing: border-box;
            /* Garis merah folio */
            background-image: linear-gradient(90deg, transparent 65px, #ffb3b3 65px, #ffb3b3 67px, transparent 67px);
        }

        .hidden-for-capture {
            visibility: hidden;
            position: absolute;
        }

        /* PERBAIKAN: Mengatur lebar tulisan agar mengikuti container */
        #textInput,
        #textDisplay {
            width: 100%;
            padding-left: 80px;
            /* Margin kiri setelah garis merah */
            padding-right: 40px;
            /* Margin kanan */
            font-family: 'Kalam', cursive;
            font-size: 17px;
            line-height: 30px;
            color: #222;
            word-wrap: break-word;
            white-space: pre-wrap;
            box-sizing: border-box;
            /* Sangat penting agar padding tidak merusak lebar */
        }

        #textInput {
            display: block;
            background: transparent;
            border: none;
            resize: none;
            outline: none;
            z-index: 2;
            position: relative;
            min-height: 1020px;
        }

        #textDisplay {
            position: absolute;
            top: 40px;
            left: 0;
            color: transparent;
            pointer-events: none;
            z-index: 3;
        }

        #contentWrapper {
            position: absolute;
            top: 40px;
            left: 0;
            width: 100%;
            z-index: 1;
            pointer-events: none;
        }

        .baris {
            height: 30px;
            border-bottom: 1px solid #e0e0e0;
            width: 100%;
            box-sizing: border-box;
        }

        .nomor-halaman {
            float: right;
            font-size: 12px;
            color: #ccc;
            margin-right: 20px;
            font-family: sans-serif;
            line-height: 30px;
        }
    </style>

    <div class="paper-container">
        <button class="btn-download" onclick="downloadGambar()">Download Surat (JPG)</button>
        <div class="folio-paper" id="folioPaper">
            <div id="contentWrapper"></div>
            <div id="textDisplay"></div>
            <textarea id="textInput" placeholder="Mulai menulis surat lamaran..."></textarea>
        </div>
    </div>

    <script>
        const textarea = document.getElementById('textInput');
        const textDisplay = document.getElementById('textDisplay');
        const container = document.getElementById('contentWrapper');
        const BARIS_PER_HALAMAN = 34;

        function updateGaris(tinggiKonten) {
            const tinggiBaris = 30;
            const totalBaris = Math.max(BARIS_PER_HALAMAN, Math.ceil(tinggiKonten / tinggiBaris));
            container.innerHTML = '';
            for (let i = 1; i <= totalBaris; i++) {
                let divBaris = document.createElement('div');
                divBaris.className = 'baris';
                if (i > 0 && i % BARIS_PER_HALAMAN === 0) {
                    divBaris.style.borderBottom = "2px dashed #bbb";
                    divBaris.innerHTML = '<span class="nomor-halaman">Halaman ' + (i / BARIS_PER_HALAMAN) + '</span>';
                }
                container.appendChild(divBaris);
            }
        }

        function adjustHeight() {
            textarea.style.height = 'auto';
            textarea.style.height = (textarea.scrollHeight + 30) + 'px';
            textDisplay.style.height = textarea.style.height;
            updateGaris(textarea.scrollHeight);
        }

        textarea.addEventListener('input', function() {
            textDisplay.textContent = this.value;
            adjustHeight();
        });

        function downloadGambar() {
            const paper = document.getElementById('folioPaper');
            const input = document.getElementById('textInput');
            const display = document.getElementById('textDisplay');

            display.textContent = input.value;
            display.style.color = '#222';
            input.classList.add('hidden-for-capture');

            html2canvas(paper, {
                scale: 2,
                useCORS: true,
                allowTaint: true,
                backgroundColor: "#fdfdfd"
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = 'Surat_Lamaran.jpg';
                link.href = canvas.toDataURL('image/jpeg', 1.0);
                link.click();

                input.classList.remove('hidden-for-capture');
                display.style.color = 'transparent';
            });
        }

        window.addEventListener('DOMContentLoaded', () => {
            textDisplay.textContent = textarea.value;
            adjustHeight();
        });
    </script>
@endsection
