<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

use App\Http\Controllers\CategoryController;

Route::get('/admin/category/index',[CategoryController::class,'index'])->name('category.index');
Route::get('/admin/category/get_all',[CategoryController::class,'get_all'])->name('category.get_all');
Route::get('/admin/category/create',[CategoryController::class,'create'])->name('category.create');
Route::post('/admin/category/store',[CategoryController::class,'store'])->name('category.store');
Route::get('/admin/category/show/{id}',[CategoryController::class,'show'])->name('category.show');
Route::get('/admin/category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
//Route::put('/admin/category/update/{id}',[CategoryController::class,'update'])->name('category.update');
Route::post('/admin/category/update',[CategoryController::class,'update'])->name('category.update');
Route::get('/admin/category/destroy/{id}',[CategoryController::class,'destroy'])->name('category.destroy');
Route::get('/admin/category/search',[CategoryController::class,'search'])->name('category.search');
Route::get('/admin/category/Pdf',[CategoryController::class,'Pdf'])->name('category.Pdf');
Route::get('/admin/category/CSV',[CategoryController::class,'CSV'])->name('category.CSV');


use App\Http\Controllers\PostController;

Route::get('/admin/post/index',[PostController::class,'index'])->name('post.index');

Route::get('/admin/post/get_all',[PostController::class,'get_all'])->name('post.get_all');

Route::get('/admin/post/create',[PostController::class,'create'])->name('post.create');
Route::post('/admin/post/store',[PostController::class,'store'])->name('post.store');
Route::get('/admin/post/show/{id}',[PostController::class,'show'])->name('post.show');
Route::get('/admin/post/edit/{id}',[PostController::class,'edit'])->name('post.edit');
//Route::put('/admin/post/update/{id}',[PostController::class,'update'])->name('post.update');
Route::post('/admin/post/update',[PostController::class,'update'])->name('post.update');

Route::post('/admin/post/photo_upload',[PostController::class,'photo_upload'])->name('post.photo_upload');

Route::get('/admin/post/destroy/{id}',[PostController::class,'destroy'])->name('post.destroy');
Route::get('/admin/post/search',[PostController::class,'search'])->name('post.search');
Route::get('/admin/post/Pdf',[PostController::class,'Pdf'])->name('post.Pdf');
Route::get('/admin/post/CSV',[PostController::class,'CSV'])->name('post.CSV');




use App\Http\Controllers\Post_photoController;

Route::get('/admin/post_photo/index',[Post_photoController::class,'index'])->name('post_photo.index');

Route::get('/admin/post_photo/get_all/{id}',[Post_photoController::class,'get_all'])->name('post_photo.get_all');

Route::get('/admin/post_photo/create',[Post_photoController::class,'create'])->name('post_photo.create');
Route::post('/admin/post_photo/store',[Post_photoController::class,'store'])->name('post_photo.store');
Route::get('/admin/post_photo/show/{id}',[Post_photoController::class,'show'])->name('post_photo.show');
Route::get('/admin/post_photo/edit/{id}',[Post_photoController::class,'edit'])->name('post_photo.edit');
Route::put('/admin/post_photo/update/{id}',[Post_photoController::class,'update'])->name('post_photo.update');
Route::get('/admin/post_photo/destroy/{id}',[Post_photoController::class,'destroy'])->name('post_photo.destroy');
Route::get('/admin/post_photo/search',[Post_photoController::class,'search'])->name('post_photo.search');
Route::get('/admin/post_photo/Pdf',[Post_photoController::class,'Pdf'])->name('post_photo.Pdf');
Route::get('/admin/post_photo/CSV',[Post_photoController::class,'CSV'])->name('post_photo.CSV');



use App\Http\Controllers\Post_videoController;

Route::get('/post_video/index',[Post_videoController::class,'index'])->name('post_video.index');
Route::get('/post_video/create',[Post_videoController::class,'create'])->name('post_video.create');
Route::post('/post_video/store',[Post_videoController::class,'store'])->name('post_video.store');
Route::get('/post_video/show/{id}',[Post_videoController::class,'show'])->name('post_video.show');
Route::get('/post_video/edit/{id}',[Post_videoController::class,'edit'])->name('post_video.edit');
//Route::put('/post_video/update/{id}',[Post_videoController::class,'update'])->name('post_video.update');
Route::post('/post_video/update/{id}',[Post_videoController::class,'update'])->name('post_video.update');
Route::get('/post_video/destroy/{id}',[Post_videoController::class,'destroy'])->name('post_video.destroy');
Route::get('/post_video/search',[Post_videoController::class,'search'])->name('post_video.search');
Route::get('/post_video/Pdf',[Post_videoController::class,'Pdf'])->name('post_video.Pdf');
Route::get('/post_video/CSV',[Post_videoController::class,'CSV'])->name('post_video.CSV');



use App\Http\Controllers\UserController;

//Login
Route::post('/login', [UserController::class, 'login'])->name('user.login');
Route::post('/register', [UserController::class, 'register'])->name('user.register');

Route::get('/admin/user/index',[UserController::class,'index'])->name('user.index');

Route::get('/admin/user/get_all',[UserController::class,'get_all'])->name('user.get_all');

Route::get('/admin/user/create',[UserController::class,'create'])->name('user.create');
Route::post('/admin/user/store',[UserController::class,'store'])->name('user.store');
Route::get('/admin/user/show/{id}',[UserController::class,'show'])->name('user.show');
Route::get('/admin/user/edit/{id}',[UserController::class,'edit'])->name('user.edit');
//Route::put('/admin/user/update/{id}',[UserController::class,'update'])->name('user.update');
Route::post('/admin/user/update/',[UserController::class,'update'])->name('user.update');

Route::post('/admin/user/photo_upload',[PostController::class,'photo_upload'])->name('user.photo_upload');

Route::get('/admin/user/destroy/{id}',[UserController::class,'destroy'])->name('user.destroy');
Route::get('/admin/user/search',[UserController::class,'search'])->name('user.search');
Route::get('/admin/user/Pdf',[UserController::class,'Pdf'])->name('user.Pdf');
Route::get('/admin/user/CSV',[UserController::class,'CSV'])->name('user.CSV');

//share
use App\Http\Controllers\ShareController;

Route::get('/admin/share/index',[ShareController::class,'index'])->name('share.index');
Route::get('/admin/share/create',[ShareController::class,'create'])->name('share.create');
Route::post('/admin/share/store',[ShareController::class,'store'])->name('share.store');
Route::get('/admin/share/show/{id}',[ShareController::class,'show'])->name('share.show');
Route::get('/admin/share/edit/{id}',[ShareController::class,'edit'])->name('share.edit');
//Route::put('/admin/share/update/{id}',[ShareController::class,'update'])->name('share.update');

Route::post('/admin/share/update/',[ShareController::class,'update'])->name('share.update');

Route::get('/admin/share/destroy/{id}',[ShareController::class,'destroy'])->name('share.destroy');
Route::get('/admin/share/search',[ShareController::class,'search'])->name('share.search');
Route::get('/admin/share/Pdf',[ShareController::class,'Pdf'])->name('share.Pdf');
Route::get('/admin/share/CSV',[ShareController::class,'CSV'])->name('share.CSV');


//Friend
use App\Http\Controllers\FriendController;

Route::get('/admin/friend/index',[FriendController::class,'index'])->name('friend.index');
Route::get('/admin/friend/create',[FriendController::class,'create'])->name('friend.create');
Route::post('/admin/friend/store',[FriendController::class,'store'])->name('friend.store');
Route::get('/admin/friend/show/{id}',[FriendController::class,'show'])->name('friend.show');
Route::get('/admin/friend/edit/{id}',[FriendController::class,'edit'])->name('friend.edit');
//Route::put('/admin/friend/update/{id}',[FriendController::class,'update'])->name('friend.update');
Route::post('/admin/friend/update',[FriendController::class,'update'])->name('friend.update');
Route::get('/admin/friend/destroy/{id}',[FriendController::class,'destroy'])->name('friend.destroy');
Route::get('/admin/friend/search',[FriendController::class,'search'])->name('friend.search');
Route::get('/admin/friend/Pdf',[FriendController::class,'Pdf'])->name('friend.Pdf');
Route::get('/admin/friend/CSV',[FriendController::class,'CSV'])->name('friend.CSV');


use App\Http\Controllers\AdminDashboardCounting;
Route::get('/admin/counting',[AdminDashboardCounting::class,'counting'])->name('admin.counting');
