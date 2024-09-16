<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Contacts;

Route::get('/', function () {
    return redirect('/contacts');
});

Route::get('/dashboard', function () {
    return redirect('/contacts');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/addContact', [Contacts::class, 'create'])->middleware(['auth', 'verified'])->name('addContact');

Route::post('/storeContact', [Contacts::class, 'store'])->middleware(['auth', 'verified']);

Route::get('/contacts',[Contacts::class, 'display'])->middleware(['auth', 'verified'])->name('contacts');

Route::get('/contacts/edit/{id}',[Contacts::class, 'edit'])->middleware(['auth', 'verified']);

Route::patch('/contacts/{id}',[Contacts::class, 'update'])->middleware(['auth', 'verified']);

Route::delete('/deleteContacts/{id}',[Contacts::class, 'destroy'])->middleware(['auth', 'verified']);

Route::post('/contacts/search',[Contacts::class, 'search'])->middleware(['auth', 'verified']);

Route::get('/welcome', function () {
    return view ('/welcome');
})->middleware(['auth', 'verified'])->name('welcome');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
