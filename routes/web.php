<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\PasswordController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
});

// 🏠 Accueil
Route::get('/', [PostController::class, 'index'])->name('home');

// 📂 Catégories
Route::get('/categories', [PostController::class, 'categories'])->name('categories.index');
Route::get('/categories/{id}', [PostController::class, 'showCategory'])->name('categories.show');

// ✉️ Contact
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// 📝 Articles
Route::get('/articles/creer', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::post('/articles', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
Route::get('/articles/{slug}/modifier', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');
Route::get('/articles/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/articles/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');
Route::put('/articles/{slug}/modifier', [PostController::class, 'update'])->name('posts.update')->middleware('auth');
Route::get('/admin/brouillons', [PostController::class, 'draft'])->name('admin.draft')->middleware('auth');
// ❤️ Interactions
Route::post('/articles/{post}/like', [PostController::class, 'like'])->name('posts.like')->middleware('auth');
Route::post('/articles/{post}/commentaires', [PostController::class, 'comment'])->name('posts.comment')->middleware('auth');
Route::delete('/commentaires/{comment}', [PostController::class, 'deleteComment'])->name('comments.delete')->middleware('auth');

// À propos
Route::view('/a-propos', 'about')->name('about');
Route::get('/admin/stat', [PostController::class, 'stat'])->name('admin.stat')->middleware('auth');
Route::get('/admin/message', [ContactController::class, 'message'])->name('admin.message')->middleware('auth');
// 🔐 Auth (Breeze gère login, logout, register, etc.)
require __DIR__.'/auth.php';