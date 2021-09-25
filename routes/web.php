<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MiniLotoController;

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

// Route::get('/', function () {
//     return redirect('/miniloto');
// });

// Route::get('/miniloto', [MiniLotoController::class, 'index']);
Route::resource('miniloto', MiniLotoController::class)->only([
    'index'
]);
Route::get('/miniloto/collation', [MiniLotoController::class, 'collation'])->name('miniloto.collation');
Route::post('/miniloto/forecast', [MiniLotoController::class, 'forecast_add']);
