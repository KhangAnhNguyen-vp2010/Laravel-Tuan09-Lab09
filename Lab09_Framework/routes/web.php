<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ArticleController;

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

// 1. Route có tham số động
Route::get('/articles/page/{page}', function ($page) {
return "Trang bài viết số: " . (int)$page;
})->whereNumber('page')->name('articles.page');

// 2. Tham số tuỳ chọn + regex slug
Route::get('/articles/slug/{slug?}', function ($slug = 'khong-co-slug') {
    return "Slug: " . $slug;
})->where('slug', '[a-z0-9-]+');

// 3. Route group với prefix
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/articles', fn() => 'Quản trị bài viết')
        ->name('admin.articles.index');
});

Route::resource('articles', ArticleController::class);

Route::post('/login-demo', function (Request $request) {
    return response()->json([
        'message' => 'Đăng nhập demo thành công',
    ]);
})->middleware('throttle:login');