<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AffiliateAd;
use App\Models\Platform;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AffiliateAdController extends Controller
{
    public function index()
    {
        // Mengambil data dengan eager loading relasi platform dan kategori
        $ads = AffiliateAd::with(['platform', 'category'])->latest()->get();
        return view('admin.affiliate-ads.index', compact('ads'));
    }

    public function create()
    {
        $platforms = Platform::all();
        $categories = Category::all();
        return view('admin.affiliate-ads.create', compact('platforms', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'platform_id' => 'required|exists:platforms,id',
            'category_id' => 'required|exists:categories,id',
            'nama_produk' => 'required|string|max:255',
            'harga_asli' => 'nullable|numeric|min:0', // Validasi harga asli
            'harga_diskon' => 'nullable|numeric|min:0', // Validasi harga diskon
            'affiliate_url' => 'required|url',
            'custom_slug' => 'nullable|string|max:100|unique:affiliate_ads,custom_slug',
            'gambar_produk' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->all();

        // Buat slug otomatis jika field custom_slug kosong
        $slug = $request->custom_slug ? Str::slug($request->custom_slug) : Str::slug($request->nama_produk) . '-' . rand(10, 99);
        $data['custom_slug'] = $slug;

        // Handle upload & kompresi gambar produk ke WebP
        if ($request->hasFile('gambar_produk')) {
            $file = $request->file('gambar_produk');

            // Buat nama unik dengan ekstensi .webp
            $filename = time() . '_' . Str::random(10) . '.webp';

            // Tentukan full path tujuan penyimpanan di folder storage (public/affiliate_ads)
            $destinationPath = storage_path('app/public/affiliate_ads');

            // Pastikan foldernya ada, jika belum buat otomatis
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $destination = $destinationPath . '/' . $filename;

            // Jalankan fungsi konversi & kompresi WebP
            $success = $this->convertToWebp($file->getRealPath(), $destination, 80); // Quality 80%

            if ($success) {
                // Simpan path relatifnya ke database: 'affiliate_ads/namafile.webp'
                $data['gambar_produk'] = 'affiliate_ads/' . $filename;
            } else {
                // Jika konversi gagal, fallback ke method upload bawaan laravel biasa
                $data['gambar_produk'] = $file->store('affiliate_ads', 'public');
            }
        }

        AffiliateAd::create($data);

        return redirect()->route('admin.affiliate-ads.index')->with('success', 'Iklan affiliate berhasil disimpan.');
    }

    public function edit(AffiliateAd $affiliateAd)
    {
        $platforms = Platform::all();
        $categories = Category::all();
        return view('admin.affiliate-ads.edit', compact('affiliateAd', 'platforms', 'categories'));
    }

    public function update(Request $request, AffiliateAd $affiliateAd)
    {
        $request->validate([
            'platform_id' => 'required|exists:platforms,id',
            'category_id' => 'required|exists:categories,id',
            'nama_produk' => 'required|string|max:255',
            'harga_asli' => 'nullable|numeric|min:0', // Validasi harga asli
            'harga_diskon' => 'nullable|numeric|min:0', // Validasi harga diskon
            'affiliate_url' => 'required|url',
            'custom_slug' => 'nullable|string|max:100|unique:affiliate_ads,custom_slug,' . $affiliateAd->id,
            'gambar_produk' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->all();

        // Logika pembuatan slug yang lebih aman saat update:
        // Jika custom_slug diisi, gunakan itu. Jika kosong tetapi nama_produk berubah, buat slug baru. Jika tidak ada perubahan, pertahankan slug lama.
        if ($request->filled('custom_slug')) {
            $data['custom_slug'] = Str::slug($request->custom_slug);
        } elseif ($request->nama_produk !== $affiliateAd->nama_produk) {
            $data['custom_slug'] = Str::slug($request->nama_produk) . '-' . rand(10, 99);
        } else {
            $data['custom_slug'] = $affiliateAd->custom_slug;
        }

        if ($request->hasFile('gambar_produk')) {
            $file = $request->file('gambar_produk');
            $filename = time() . '_' . Str::random(10) . '.webp';
            $destinationPath = storage_path('app/public/affiliate_ads');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $destination = $destinationPath . '/' . $filename;
            $success = $this->convertToWebp($file->getRealPath(), $destination, 80);

            if ($success) {
                // Hapus gambar lama dari storage agar tidak memenuhi server
                if ($affiliateAd->gambar_produk) {
                    Storage::disk('public')->delete($affiliateAd->gambar_produk);
                }
                $data['gambar_produk'] = 'affiliate_ads/' . $filename;
            } else {
                if ($affiliateAd->gambar_produk) {
                    Storage::disk('public')->delete($affiliateAd->gambar_produk);
                }
                $data['gambar_produk'] = $file->store('affiliate_ads', 'public');
            }
        }

        $affiliateAd->update($data);

        return redirect()->route('admin.affiliate-ads.index')->with('success', 'Iklan affiliate berhasil diperbarui.');
    }
    public function destroy(AffiliateAd $affiliateAd)
    {
        if ($affiliateAd->gambar_produk) {
            Storage::disk('public')->delete($affiliateAd->gambar_produk);
        }

        $affiliateAd->delete();
        return redirect()->route('admin.affiliate-ads.index')->with('success', 'Iklan affiliate berhasil dihapus.');
    }


    // Fungsi konversi WebP milikmu ditaruh di bawah sini
    private function convertToWebp($source, $destination, $quality = 80)
    {
        $info = getimagesize($source);
        $mime = $info['mime'];

        switch ($mime) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($source);
                break;
            case 'image/png':
                $image = imagecreatefrompng($source);
                imagepalettetotruecolor($image);
                imagealphablending($image, true);
                imagesavealpha($image, true);
                break;
            case 'image/webp':
                $image = imagecreatefromwebp($source);
                break;
            default:
                return false;
        }

        imagewebp($image, $destination, $quality);
        imagedestroy($image);

        return true;
    }
}
