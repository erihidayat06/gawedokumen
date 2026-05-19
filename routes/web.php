<?php

use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminCvController;
use App\Http\Controllers\Admin\AdminLokerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Pekerja\CvController;
use App\Http\Controllers\Pekerja\SuratLamaranController;
use App\Http\Controllers\Pekerja\KirimEmailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Tools\GabungPdfController;
use App\Http\Controllers\Tools\KompresGambarController;
use App\Http\Controllers\Tools\KompresPdfController;
use App\Http\Controllers\Tools\SignatureController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Services\GoogleIndexingService;

Route::get('/kategori/{kategori}', [HomeController::class, 'show']);
Route::get('/', [HomeController::class, 'index']);


Route::prefix('tool')->name('tool.')->group(function () {
    Route::get('tanda-tangan-digital', [SignatureController::class, 'index'])->name('signature');
    Route::get('kompres-pdf', [KompresPdfController::class, 'index'])->name('kompres.pdf.index');
    Route::post('kompres-pdf', [KompresPdfController::class, 'compress'])->name('kompres.pdf');
    Route::get('kompres-gambar', [KompresGambarController::class, 'index'])->name('kompres.gambar.index');
    Route::post('kompres-gambar', [KompresGambarController::class, 'store'])->name('kompres.gambar');

    // Route untuk menampilkan halaman form Gabung PDF
    Route::get('/gabung-pdf', [GabungPdfController::class, 'index'])->name('pdf.merge.index');

    // Route POST untuk memproses penggabungan dokumen PDF
    Route::post('/gabung-pdf', [GabungPdfController::class, 'merge'])->name('pdf.merge');
});




Route::prefix('blog')->name('blog.')->group(function () {
    // 1. Halaman Utama Blog (domain.com/blog)
    Route::get('/', [BlogController::class, 'index'])->name('index');

    // 2. Rute Lama (domain.com/blog/tutorial/8/slug)
    // Tetap ditaruh di atas rute slug baru untuk menghindari bentrok jika ada kategori yang namanya mirip
    // Route::get('/{kategori}/{id}/{slug}', [BlogController::class, 'detail']);

    // 3. Rute Baru (domain.com/blog/slug-bersih)
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
});

Route::prefix('loker')->group(function () {
    // Halaman Utama Loker (Daftar semua loker)
    Route::get('/', [LokerController::class, 'index'])->name('loker.index');

    // Halaman Detail Loker (Menggunakan Slug untuk SEO)
    Route::get('/{slug}', [LokerController::class, 'show'])->name('loker.show');

    // Opsional: Filter berdasarkan wilayah/kecamatan
    Route::get('/wilayah/{kota}', [LokerController::class, 'wilayah'])->name('loker.wilayah');
});


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/blog', [AdminBlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/create', [AdminBlogController::class, 'create'])->name('blog.create');
    Route::post('/blog/store', [AdminBlogController::class, 'store'])->name('blog.store');
    Route::post('/blog/upload-image', [AdminBlogController::class, 'uploadImage'])->name('blog.upload_image');
    Route::get('/blog/{blog:id}/edit', [AdminBlogController::class, 'edit'])->name('blog.edit');
    Route::get('/blog/{blog:slug}', [AdminBlogController::class, 'show'])->name('blog.show');
    Route::put('/blog/{blog:id}/update', [AdminBlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{blog:id}/delete', [AdminBlogController::class, 'destroy'])->name('blog.destroy');
    Route::resource('cv', AdminCvController::class);
    Route::resource('loker', AdminLokerController::class);
});


Route::prefix('pekerja')->name('pekerja.')->group(function () {
    Route::get('/surat-lamaran', [SuratLamaranController::class, 'index'])->name('surat.lamaran');
    Route::get('/generate-cv', [CvController::class, 'index'])->name('generate.cv');
    Route::get('/kirim-lamaran-email', [KirimEmailController::class, 'index'])->name('kirim.lamaran.email');
});

// POST untuk menerima form
Route::post('/generate-pdf-cv', [CvController::class, 'generatePdf'])->name('cv.pdf.generate');

// GET untuk preview / hasil
Route::get('/preview-pdf-cv', [CvController::class, 'previewPdf'])
    ->name('cv.pdf.preview');


Route::post('/generate-pdf', [DocumentController::class, 'generate'])
    ->name('pdf.generate');

Route::get('/preview-pdf', [DocumentController::class, 'preview'])
    ->name('pdf.preview');


Route::get('/tentang-kami', [PageController::class, 'about'])->name('about');
Route::get('/kebijakan-privasi', [PageController::class, 'privacy'])->name('privacy');
Route::get('/syarat-ketentuan', [PageController::class, 'terms'])->name('terms');
Route::get('/contact', [PageController::class, 'contact'])->name('kontak');
Route::post('/kontak/kirim', [ContactController::class, 'send'])->name('kontak.send');


Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index']);




Route::get('/test-indexing', function () {
    try {
        $service = new GoogleIndexingService();
        // Coba pakai URL publik sembarang untuk tes format
        $response = $service->updateUrl('https://gawedokumen.com');
        return response()->json(['status' => 'Sukses!', 'data' => $response]);
    } catch (\Exception $e) {
        return response()->json(['status' => 'Gagal', 'error' => $e->getMessage()], 500);
    }
});



require __DIR__ . '/auth.php';
