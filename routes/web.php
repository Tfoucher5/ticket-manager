<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/', [TicketController::class, 'compteurs'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Gestion des tickets
    Route::resource('tickets', TicketController::class);

    // Ajouter un commentaire à un ticket
    Route::post('/tickets/{ticket}/commentaires', [CommentaireController::class, 'store'])->name('commentaires.store');

    //Assigner le ticket à un développeur
    Route::patch('tickets/{ticket}', [TicketController::class, 'assign'])->name('tickets.assign');

    // Route pourafficher les détails d'un ticket
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');

    Route::put('/tickets/{ticket}/resolve', [TicketController::class, 'resolve'])->name('tickets.resolve');
    Route::put('/tickets/{ticket}/cancel', [TicketController::class, 'cancel'])->name('tickets.cancel');


    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');


});

require __DIR__.'/auth.php';
