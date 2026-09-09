<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\MonProfilController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Profil Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Mon profil
    Route::get('/mon-profil', [MonProfilController::class, 'show'])->name('profil.show');
    Route::get('/mon-profil/modifier', [MonProfilController::class, 'edit'])->name('profil.edit');
    Route::patch('/mon-profil', [MonProfilController::class, 'update'])->name('profil.update');

    // Offres
    Route::resource('offres', OffreController::class);

    // Candidatures
    Route::post('/candidatures', [CandidatureController::class, 'store'])->name('candidatures.store');
    Route::get('/mes-candidatures', [CandidatureController::class, 'index'])->name('candidatures.index');
    Route::get('/candidatures-recues', [CandidatureController::class, 'received'])->name('candidatures.received');
    Route::patch('/candidatures/{candidature}/statut', [CandidatureController::class, 'updateStatut'])->name('candidatures.updateStatut');

    // Admin
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
        Route::get('/offres', [AdminController::class, 'offres'])->name('offres');
        Route::delete('/offres/{offre}', [AdminController::class, 'deleteOffre'])->name('offres.delete');
        Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
        Route::post('/categories', [AdminController::class, 'storeCategorie'])->name('categories.store');
        Route::delete('/categories/{categorie}', [AdminController::class, 'deleteCategorie'])->name('categories.delete');
    });

});

require __DIR__.'/auth.php';