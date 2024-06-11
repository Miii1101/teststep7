<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// ログイン画面
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// 検索画面表示
Route::get('/index', [App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
// 検索機能
Route::get('/get', [App\Http\Controllers\ProductController::class, 'search'])->name('product.search');
// 削除処理
Route::delete('/delete/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.destroy');
// 商品登録画面表示
Route::get('/create', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
// 登録処理
Route::post('/store', [App\Http\Controllers\ProductController::class, 'store'])->name('regist.product');
// 詳細画面
Route::get('/product/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.detail');
// 編集画面
Route::get('/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
// 更新処理
Route::put('/edit/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');

