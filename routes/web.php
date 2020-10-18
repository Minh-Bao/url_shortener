<?php

use App\Models\Url;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/',function() {  
    $url = request('url');

    $data = ['url' => $url];

    Validator::make(
        compact('url'), 
        ['url' => 'required|url']
    )->validate();

    $record = Url::whereUrl($url)->first(); 
    if($record) {                                     
        return view('result')->with('shortened', $url->shortened  ); 
    }
    
    $row = Url::create([           
        'url' => $url,
        'shortened' => Url::getUniqueShortUrl(),
    ]);

    if($row) {
        return view('result')->withShortened($row->shortened  ); 
    }else{
        return view('error');
    }
});


Route::get('/{shortened}', function ($shortened) {
    $url = Url::whereShortened($shortened)->first();

    if(! $url){
        return Redirect::to('/');
    }

    return Redirect::to($url->url);
});    
