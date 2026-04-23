<?php

use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Pekerja\CvController;
use App\Http\Controllers\Pekerja\SuratLamaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Tools\KompresPdfController;
use App\Http\Controllers\Tools\SignatureController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/kategori/{kategori}', [HomeController::class, 'show']);
Route::get('/', [HomeController::class, 'index']);


Route::prefix('tool')->name('tool.')->group(function () {
    Route::get('tanda-tangan-digital', [SignatureController::class, 'index'])->name('signature');
    Route::get('kompres-pdf', [KompresPdfController::class, 'index'])->name('kompres.pdf.index');
    Route::post('kompres-pdf', [KompresPdfController::class, 'compress'])->name('kompres.pdf');
});




Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{ketegori}/{id}/{slug}', [BlogController::class, 'detail'])->name('blog.show');


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/blog', [AdminBlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/create', [AdminBlogController::class, 'create'])->name('blog.create');
    Route::post('/blog/store', [AdminBlogController::class, 'store'])->name('blog.store');
    Route::post('/blog/upload-image', [AdminBlogController::class, 'uploadImage'])->name('blog.upload_image');
    Route::get('/blog/{blog:id}/edit', [AdminBlogController::class, 'edit'])->name('blog.edit');
    Route::get('/blog/{blog:slug}', [AdminBlogController::class, 'show'])->name('blog.show');
    Route::put('/blog/{blog:id}/update', [AdminBlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{blog:id}/delete', [AdminBlogController::class, 'destroy'])->name('blog.destroy');
});


Route::prefix('pekerja')->name('pekerja.')->group(function () {
    Route::get('/surat-lamaran', [SuratLamaranController::class, 'index'])->name('surat.lamaran');
    Route::get('/generate-cv', [CvController::class, 'index'])->name('generate-cv');
});


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

Route::get('/generate-pdf', [DocumentController::class, 'generate'])->name('pdf.generate');

require __DIR__ . '/auth.php';
