<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ログインしているユーザーのみの投稿一覧
Route::middleware(['auth'])->group(function () {
    Route::get('/my-posts', [PostController::class, 'myPosts'])->name('my-posts');
});

// 認証しているユーザー一覧
Route::middleware(['auth'])->group(function () {
    Route::get('/friends', [UserController::class, 'friends'])->name('friends');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('create');
    Route::resource('weathers', WeatherController::class);
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('show');
    Route::post('/posts', [PostController::class, 'store'])->name('store');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('update');
    Route::delete('/posts/{post}', [PostController::class, 'delete'])->name('delete');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('edit');
});

// 他のルート
Route::get('/categories/{category}', [CategoryController::class,'index'])->middleware("auth")->name('categories.index'); 

// 家族構成のルート
Route::middleware(['auth'])->group(function () {
    Route::get('/family/familystructure', [ChildController::class, 'familystructure'])->name('familystructure');
    Route::post('/family', [ChildController::class, 'store'])->name('family.store');
    Route::delete('/family/{id}', [ChildController::class, 'destroy'])->name('family.destroy');
});

// 招待メール
Route::middleware(['auth'])->group(function() {
    Route::get('/invitation/form', [InvitationController::class, 'showForm'])->name('form');
    Route::post('/invite', [InvitationController::class, 'sendInvitation']);
});

//友達
Route::post('/accept-friendship/{friend}', 'FriendshipController@acceptFriendship')->name('acceptFriendship');

// ゲストユーザー登録
Route::get('/accept-invitation/{token}', [InvitationController::class, 'showAcceptForm'])
    ->name('guest.register.form');
Route::post('/accept-invitation/{token}', [InvitationController::class, 'acceptInvitation'])
    ->name('guest.register');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';