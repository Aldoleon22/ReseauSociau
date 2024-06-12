<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;


Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('/profile', [UserController::class, 'showProfile'])->name('profile')->middleware('auth');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});
Route::middleware(['auth.redirect'])->group(function () {
    // Vos routes nécessitant une authentification
});
Route::get('/friends', [UserController::class, 'friends'])->name('users.friends');

Route::get('/accepted-requests', [FriendshipController::class, 'acceptedRequests'])->name('accepted_requests');



Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/profile/{user}', [UserController::class, 'show'])->name('profile.show');
    // Route::get('/friends', [UserController::class, 'friends'])->name('friends');
    
    Route::post('/friend-request/send/{receiverId}', [FriendshipController::class, 'sendRequest'])->name('friend-request.send');
    Route::post('/friend-request/accept/{friendshipId}', [FriendshipController::class, 'acceptRequest'])->name('friend-request.accept');
    Route::post('/friend-request/decline/{friendshipId}', [FriendshipController::class, 'declineRequest'])->name('friend-request.decline');
    Route::get('/friend-requests', [FriendshipController::class, 'pendingRequests'])->name('friend-requests.pending');
});

Route::post('/comments/{postId}', [BlogController::class, 'storeComment'])->name('comments.store');

Route::get('/profile/{user}', [Controller::class, 'show'])->name('profile.show')->middleware('auth');


    Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/', function () {   
    return view('welcome');
});

// Routes d'authentification
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/login', [AuthController::class, 'doLogin']);

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('/profile', [AuthController::class, 'show'])->name('auth.profile');

// Routes du blog
Route::prefix('/blog')->name('blog.')->controller(BlogController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/new', 'create')->name('create')->middleware('auth');
    Route::post('/new', 'store')->middleware('auth');
    Route::get('/{post}/edit', 'edit')->name('edit')->middleware('auth');
    Route::post('/{post}/edit', 'update')->name('edit')->middleware('auth');
    Route::get('/{slug}-{post}', 'show')->where([
        'post' => '[0-9]+',
        'slug' => '[a-z0-9\-]+'
    ])->name('show');
    Route::delete('/{post}/edit','delete')->name('edit');
});
