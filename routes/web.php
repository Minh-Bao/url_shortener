<?php

use App\Models\Url;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\UrlsController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


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

Route::get('/', 'App\Http\Controllers\UrlsController@create');

Route::post('/', 'App\Http\Controllers\UrlsController@store');

Route::get('/{shortened}', 'App\Http\Controllers\UrlsController@show');
 
