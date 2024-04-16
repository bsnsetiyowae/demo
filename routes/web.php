<?php

use Illuminate\Support\Facades\Route;
use App\Support\Page;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::prefix(LaravelLocalization::setLocale())
    ->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])
    ->group(function () {

        Route::get('/', function () {
            $index = (new Page(app()->getLocale(), 'docs'))->getSidebar();

            return view('welcome', compact('index'));
        });

        Route::get('/{type}/{page?}', function (string $type, ?string $page = 'index') {
            return (new Page(app()->getLocale(), $type, $page))->view($type);
        })->where('page', '.*')->name('page.show');
    });
