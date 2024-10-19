<?php

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

/*Route::get('/', function () {
    return view('app');
});*/

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');



use App\Http\Controllers\CategoryController;

Route::get('/category/index',[CategoryController::class,'index'])->name('category.index');
Route::get('/category/create',[CategoryController::class,'create'])->name('category.create');
Route::post('/category/store',[CategoryController::class,'store'])->name('category.store');
Route::get('/category/show/{id}',[CategoryController::class,'show'])->name('category.show');
Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
Route::put('/category/update/{id}',[CategoryController::class,'update'])->name('category.update');
Route::get('/category/destroy/{id}',[CategoryController::class,'destroy'])->name('category.destroy');
Route::get('/category/search',[CategoryController::class,'search'])->name('category.search');
Route::get('/category/Pdf',[CategoryController::class,'Pdf'])->name('category.Pdf');
Route::get('/category/CSV',[CategoryController::class,'CSV'])->name('category.CSV');
          
