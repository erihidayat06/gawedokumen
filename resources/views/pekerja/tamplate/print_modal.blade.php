 <div id="printAdModal"
     class="fixed inset-0 z-[999] hidden flex items-center justify-center bg-slate-900/90 backdrop-blur-md p-4">
     <div
         class="bg-white dark:bg-slate-900 w-full max-w-md rounded-[2.5rem] p-8 shadow-2xl border border-slate-100 dark:border-slate-800">

         <div id="loadingState" class="text-center mb-6">
             <div
                 class="w-14 h-14 border-4 border-emerald-100 border-t-emerald-600 rounded-full animate-spin mx-auto mb-4">
             </div>
             <h3 class="text-xl font-black dark:text-white">Menyiapkan Dokumen...</h3>
             <p class="text-sm text-slate-500">Mohon tunggu sebentar</p>
         </div>

         <div id="readyState" class="hidden text-center mb-6">
             <div
                 class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                 <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                 </svg>
             </div>
             <h3 class="text-xl font-black dark:text-white">Dokumen Siap!</h3>
             <p class="text-sm text-slate-500">Silakan klik tombol di bawah</p>
         </div>

         <div
             class="my-6 min-h-[250px] bg-slate-50 dark:bg-slate-800/50 rounded-3xl border border-dashed border-slate-200 dark:border-slate-700 flex flex-col items-center justify-center p-4">
             <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-2">Advertisement</span>
             <div class="text-slate-300 italic text-xs text-center">
                 {{-- Taruh Script Iklan AdSense Kamu Di Sini --}}
                 Iklan Display akan muncul di area ini
             </div>
         </div>

         <div class="flex flex-col gap-3">
             <button id="btnRealPrint" disabled
                 class="w-full py-4 bg-slate-200 text-slate-400 font-bold rounded-2xl transition-all cursor-not-allowed flex items-center justify-center gap-1">
                 <span id="btnText">Tunggu</span>
                 <span id="adTimerSpan"><span id="adTimer">5</span>s</span>
             </button>
             <button onclick="closeAdModal()"
                 class="text-sm font-bold text-slate-400 hover:text-red-500 transition-colors">
                 Batal
             </button>
         </div>
     </div>
 </div>
