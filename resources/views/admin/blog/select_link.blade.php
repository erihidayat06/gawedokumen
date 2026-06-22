   <select class="form-select" id="select-link" aria-label="Default select example">
       <option selected>Open this select menu</option>
       <option value="/pekerja/surat-lamaran?kualif_keahlian=">Surat Lamaran Kerja</option>
       <option value="/pekerja/surat-resign?alasan=">Surat Resign</option>
       <option value="/pekerja/generate-cv">Cv</option>
   </select>

   @push('scriptsLink')
       <script>
           // Fungsi Tambahkan Link ke CKEditor
           document.getElementById('tambah-link').addEventListener('click', function() {
               const selectElem = document.getElementById('select-link');
               const baseUrl = selectElem.value; // Contoh: "/pekerja/surat-lamaran?kualif_keahlian="
               const userInput = document.getElementById('text').value; // Contoh: "Sangat ahli di bidang mesin"
               const labelLink = "Dapatkan Draf Surat";

               if (baseUrl === "Open this select menu") {
                   alert("Pilih jenis link terlebih dahulu!");
                   return;
               }

               // Gabungkan URL dasar dengan input user
               // Karena sudah ada ?, kita tinggal menambahkan inputnya langsung
               const finalUrl = window.location.origin + baseUrl + encodeURIComponent(userInput);

               // Tambahkan &nbsp; (spasi kosong) atau spasi biasa setelah tag </a>
               const fullLink = `<a href="${finalUrl}" target="_blank">${labelLink}</a>&nbsp;`;

               // Sisipkan ke Editor
               if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.editor) {
                   CKEDITOR.instances.editor.insertHtml(fullLink);
               } else {
                   const textarea = document.getElementById('editor');
                   textarea.value += fullLink;
               }
           });

           function previewImage() {
               const image = document.querySelector('#gambarInput');
               const imgPreview = document.querySelector('#imgPreview');
               if (image.files && image.files[0]) {
                   imgPreview.style.display = 'block';
                   const oFReader = new FileReader();
                   oFReader.readAsDataURL(image.files[0]);
                   oFReader.onload = function(oFREvent) {
                       imgPreview.src = oFREvent.target.result;
                   };
               }
           }

           const judul = document.querySelector('#judul');
           const slug = document.querySelector('#slug');

           judul.addEventListener('keyup', function() {
               let text = judul.value.toLowerCase()
                   .replace(/[^a-z0-9 -]/g, '')
                   .replace(/\s+/g, '-')
                   .replace(/-+/g, '-');
               slug.value = text;
           });

           slug.addEventListener('input', function() {
               this.value = this.value.toLowerCase()
                   .replace(/[^a-z0-9 -]/g, '')
                   .replace(/\s+/g, '-');
           });
       </script>
   @endpush
