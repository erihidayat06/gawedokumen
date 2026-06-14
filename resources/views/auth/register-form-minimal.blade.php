<div class="text-center mb-8">
    <h2 class="text-2xl font-black text-slate-800 dark:text-white">Buat Akun Baru</h2>
    <p class="text-slate-500 text-sm mt-1">Bergabung untuk akses fitur lengkap</p>
</div>

{{-- Wrapper utama untuk Modal dan Form --}}
<div x-data="{ showModal: false, modalView: '' }">

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        @if (isset($loker))
            <input type="hidden" name="loker_id_to_save" value="{{ $loker->id }}">
        @endif

        {{-- Input Fields --}}
        <div class="relative">
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1 ml-1">Nama
                Lengkap</label>
            <input type="text" name="name" required
                class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/50 rounded-xl border-none focus:ring-2 focus:ring-blue-600 outline-none">
        </div>

        <div class="relative">
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1 ml-1">Email</label>
            <input type="email" name="email" required
                class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/50 rounded-xl border-none focus:ring-2 focus:ring-blue-600 outline-none">
        </div>

        <div class="relative">
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1 ml-1">Password</label>
            <input type="password" name="password" required
                class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/50 rounded-xl border-none focus:ring-2 focus:ring-blue-600 outline-none">
        </div>

        {{-- AREA CHECKBOX --}}
        <div class="space-y-3 mt-4">
            <div class="flex items-start gap-3">
                <input type="checkbox" name="terms" id="terms" required
                    class="mt-1 h-5 w-5 rounded border-slate-300 text-blue-600 cursor-pointer">
                <label for="terms" class="text-sm text-slate-600 dark:text-slate-400">
                    Saya setuju dengan
                    <button type="button" @click="showModal = true; modalView = 'terms'"
                        class="text-blue-600 font-bold hover:underline">Syarat & Ketentuan</button>
                    dan
                    <button type="button" @click="showModal = true; modalView = 'privacy'"
                        class="text-blue-600 font-bold hover:underline">Kebijakan Privasi</button>.
                </label>
            </div>

            <div class="flex items-start gap-3">
                <input type="checkbox" name="subscribe" id="subscribe" checked
                    class="mt-1 h-5 w-5 rounded border-slate-300 text-blue-600 cursor-pointer">
                <label for="subscribe" class="text-sm text-slate-600 dark:text-slate-400">
                    Kirimkan saya pembaruan, tips, dan informasi penting lainnya melalui email.
                </label>
            </div>
        </div>

        <button type="submit"
            class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-xl transition">Daftar
            Sekarang</button>
    </form>

    <div x-show="showModal" x-cloak
        class="fixed inset-0 z-[100] flex items-center justify-center p-0 !m-0 bg-slate-900/60 backdrop-blur-sm">


        <div @click.away="showModal = false" {{-- Tambahkan rounded-none untuk mobile agar benar-benar edge-to-edge --}}
            class=" border border-slate-200 dark:border-slate-800 w-full max-w-lg max-h-screen md:max-h-[80vh] h-full md:h-auto overflow-y-auto p-6 shadow-2xl transition-colors duration-300 rounded-none md:rounded-3xl">
            {{-- Header Modal --}}
            <div class="flex justify-between items-center mb-6 sticky top-0 bg-white/95 dark:bg-slate-950/95 py-2 z-10">
                <h3 class="text-xl font-black text-slate-800 dark:text-white">
                    Informasi Legal
                </h3>
                <button type="button" @click="showModal = false"
                    class="text-slate-400 hover:text-slate-600 font-bold text-sm tracking-widest uppercase">
                    Tutup
                </button>
            </div>

            {{-- Konten Modal --}}
            <div class="prose dark:prose-invert max-w-none text-slate-600 dark:text-slate-400">
                <div x-show="modalView === 'terms'">
                    @include('pages.terms-widget')
                </div>
                <div x-show="modalView === 'privacy'">
                    @include('pages.privacy-widget')
                </div>
            </div>
        </div>
    </div>
</div>
