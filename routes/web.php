<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\EpisodesController;

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

Route::get('/', function () {
    return redirect('/series');
});

Route::resource('/series', SeriesController::class);
    //->except(['show']);
    //->only(['index', 'create', 'store', 'destroy', 'edit']); // Caso use os nomes de controllers padroes do Laravel (so usar a funcao route() para chamar o nome das rotas)

// https://laravel.com/docs/10.x/controllers#actions-handled-by-resource-controller
//Route::controller(SeriesController::class)->group(function () {
//    Route::get('/series', 'index')->name('series.index');
//    Route::get('/series/create', 'create')->name('series.create');
//    Route::post('/series/save', 'store')->name('series.store');
//    Route::delete('/series/destroy/{series}', 'destroy')->name('series.destroy'); // Para o metodo delete funcionar deve ser adicionado ao formulario o @methos('DELETE'), assim o laravel vai mandar um input a mais informando que o metodo deveria ser delete e vai entar no padrao de resource controllers
//});

Route::resource('/series/{series}/seasons', SeasonsController::class)
    ->only(['index']);

Route::resource('/seasons/{season}/episodes', EpisodesController::class)
    ->only(['index', 'edit', 'update']);
//Route::get('/seasons/{season}/episodes', [ EpisodesController::class, 'index' ])->name('episodes.index');
