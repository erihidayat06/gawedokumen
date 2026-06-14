<div class="text-center mb-8">
    <h2 class="text-2xl font-black text-slate-800 dark:text-white">Selamat Datang!</h2>
    <p class="text-slate-500 text-sm mt-1">Silakan masuk ke akun Anda</p>
</div>

<form method="POST" action="{{ route('login') }}" class="space-y-4">
    @csrf
    <input type="hidden" name="url_intended" value="{{ url()->current() }}">
    @if (isset($loker))
        <input type="hidden" name="loker_id_to_save" value="{{ $loker->id }}">
    @endif
    <div class="relative">
        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1 ml-1">Email</label>
        <div class="relative flex items-center">
            <i class="bi bi-envelope absolute left-4 text-slate-400"></i>
            <input type="email" name="email" required
                class="w-full pl-12 pr-4 py-3 bg-slate-50 dark:bg-slate-700/50 rounded-xl border-none focus:ring-2 focus:ring-blue-500 transition outline-none">
        </div>
    </div>
    <div class="relative">
        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1 ml-1">Password</label>
        <div class="relative flex items-center">
            <i class="bi bi-lock absolute left-4 text-slate-400"></i>
            <input type="password" name="password" required
                class="w-full pl-12 pr-4 py-3 bg-slate-50 dark:bg-slate-700/50 rounded-xl border-none focus:ring-2 focus:ring-blue-500 transition outline-none">
        </div>
    </div>
    @if ($errors->any())
        <div class="text-red-500 text-xs mt-2 font-bold">
            {{ $errors->first() }}
        </div>
    @endif
    <button type="submit"
        class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-xl transition shadow-xl shadow-blue-600/20 active:scale-[0.98]">
        Masuk Sekarang
    </button>
</form>
