<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Impor Storage

class PlatformController extends Controller
{
    public function index()
    {
        $platforms = Platform::latest()->get();
        return view('admin.platforms.index', compact('platforms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_platform' => 'required|string|max:100',
            'logo_platform' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:1024', // Validasi file gambar
        ]);

        $data = $request->only('nama_platform');

        // Proses Upload Gambar
        if ($request->hasFile('logo_platform')) {
            $data['logo_platform'] = $request->file('logo_platform')->store('platforms', 'public');
        }

        Platform::create($data);

        return redirect()->route('admin.platforms.index')->with('success', 'Platform berhasil ditambahkan.');
    }

    public function update(Request $request, Platform $platform)
    {
        $request->validate([
            'nama_platform' => 'required|string|max:100',
            'logo_platform' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:1024',
        ]);

        $data = $request->only('nama_platform');

        if ($request->hasFile('logo_platform')) {
            // Hapus logo lama jika ada sebelum upload yang baru
            if ($platform->logo_platform) {
                Storage::disk('public')->delete($platform->logo_platform);
            }
            $data['logo_platform'] = $request->file('logo_platform')->store('platforms', 'public');
        }

        $platform->update($data);

        return redirect()->route('admin.platforms.index')->with('success', 'Platform berhasil diperbarui.');
    }

    public function destroy(Platform $platform)
    {
        // Hapus file logo dari storage saat data dihapus
        if ($platform->logo_platform) {
            Storage::disk('public')->delete($platform->logo_platform);
        }

        $platform->delete();
        return redirect()->route('admin.platforms.index')->with('success', 'Platform berhasil dihapus.');
    }
}
