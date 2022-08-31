<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\MessagesController;

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

/**
 * Auth Routes
 */
Auth::routes();
Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');


/**
 * Home routes
 */
Route::get('/home', [HomeController::class, 'index'])->name('home');


/**
 * News Article routes
 */
Route::get('/', [ApiController::class, 'displayNews'])->name('index');
Route::post('/sourceId', [ApiController::class, 'displayNews']);
Route::post('/loadMore', [ApiController::class, 'loadMoreNews']);
Route::post('/newsDetail', [ApiController::class, 'displaySingleNewsDetail'])->name('articleDetail');
Route::get('/newsDetail', [ApiController::class, 'getSingleNewsDetail'])->name('getArticleDetail');

Route::resource('messages', MessagesController::class);