<?php

use App\Http\Controllers\AdminBookController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminQuoteController;
use App\Http\Controllers\ProfileController;
use App\Models\Quote;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', function () {
    $latestQuote = Quote::latest()->first(); // Get the latest quote
    return view('signin', compact('latestQuote'));
});

// Route::get('/', function () {
//     return view('signin');
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('admin.books.index');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.books.index');
    // Book routes
    Route::resource('admin/books', AdminBookController::class)->names([
        'index' => 'admin.books.index',
        'create' => 'admin.books.create',
        'store' => 'admin.books.store',
        'edit' => 'admin.books.edit',
        'update' => 'admin.books.update',
        'destroy' => 'admin.books.destroy',
    ]);

    // Quote routes
    Route::resource('admin/quotes', AdminQuoteController::class)->names([
        'index' => 'admin.quotes.index',
        'create' => 'admin.quotes.create',
        'store' => 'admin.quotes.store',
        'edit' => 'admin.quotes.edit',
        'update' => 'admin.quotes.update',
        'destroy' => 'admin.quotes.destroy',
    ]);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Define a custom route to show a book using its slug
    Route::get('admin/books/{slug}', [AdminBookController::class, 'show'])->name('admin.books.show');
});

// Add your custom registration route
Route::get('/signup', function () {
    return view('signup');
})->name('signup');

// Add your custom registration route
Route::get('/signin', function () {
    return view('signin');
})->name('signin');


require __DIR__.'/auth.php';
