@extends('layouts.app')

@section('content')
    <div class="min-h-screen py-20 px-4">
        <div class="max-w-5xl mx-auto">

            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white mb-4">
                    Ada Pertanyaan? <span class="text-blue-600">Hubungi Kami</span>
                </h1>
                <p class="text-slate-500 dark:text-slate-400 max-w-2xl mx-auto">
                    Kritik, saran, atau laporan bug sangat kami harapkan demi perkembangan <strong>GaweDokumen</strong> yang
                    lebih baik.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                {{-- Info Kontak --}}
                <div class="md:col-span-1 space-y-6">
                    <div
                        class="p-8 bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-sm">
                        <div
                            class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 text-blue-600 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold dark:text-white mb-2">Email</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Kirim pesan kapan saja.</p>
                        <a href="mailto:support@gawedokumen.com"
                            class="text-blue-600 font-bold mt-4 block">support@gawedokumen.com</a>
                    </div>

                    <div
                        class="p-8 bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-sm">
                        <div
                            class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold dark:text-white mb-2">Lokasi</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Tegal, Jawa Tengah, Indonesia.</p>
                    </div>
                </div>


                {{-- Floating Success Alert --}}
                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-x-8"
                        x-transition:enter-end="opacity-100 transform translate-x-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 transform translate-x-0"
                        x-transition:leave-end="opacity-0 transform translate-x-8"
                        class="fixed top-5 right-5 z-[100] flex items-center w-full max-w-xs p-4 space-x-4 text-emerald-700 bg-emerald-50 rounded-3xl shadow-xl border border-emerald-100 ring-1 ring-emerald-500/10"
                        role="alert">

                        <div
                            class="flex-shrink-0 w-10 h-10 bg-emerald-500 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-500/30">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>

                        <div class="flex-1 text-sm font-bold tracking-tight">
                            {{ session('success') }}
                        </div>

                        <button @click="show = false" class="text-emerald-400 hover:text-emerald-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                @endif


                {{-- Form Kontak --}}
                <div class="md:col-span-2">
                    <form action="{{ route('kontak.send') }}" method="POST"
                        class="bg-white dark:bg-slate-900 rounded-[2.5rem] p-8 md:p-12 border border-slate-100 dark:border-slate-800 shadow-sm space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-bold dark:text-white ml-2">Nama Lengkap</label>
                                <input type="text" placeholder="Masukkan nama..." name="nama"
                                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-none focus:ring-2 focus:ring-blue-600 dark:text-white transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold dark:text-white ml-2">Alamat Email</label>
                                <input type="email" placeholder="email@contoh.com" name="email"
                                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-none focus:ring-2 focus:ring-blue-600 dark:text-white transition-all">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-bold dark:text-white ml-2">Subjek</label>
                            <input type="text" name="subjek" placeholder="Ada yang bisa dibantu?"
                                class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-none focus:ring-2 focus:ring-blue-600 dark:text-white transition-all"
                                required>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-bold dark:text-white ml-2">Pesan</label>
                            <textarea name="pesan" rows="5" placeholder="Tuliskan pesan Anda di sini..."
                                class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-none focus:ring-2 focus:ring-blue-600 dark:text-white transition-all"
                                required></textarea>
                        </div>

                        <button type="submit"
                            class="w-full py-4 bg-blue-600 text-white font-bold rounded-2xl hover:bg-blue-700 shadow-lg shadow-blue-600/20 transition-all active:scale-95">
                            Kirim Pesan
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
