<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/paste', 'PasteController@save');
Route::post('/paste/unlock', 'UnlockController@unlock');

Route::get('/paste/raw/{slug}', 'RawController@raw');
Route::get('/paste/embed/{slug}.js', 'EmbedController@embed');

Route::get('/paste/{slug}', 'PasteController@get');


