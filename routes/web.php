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
    /**
     * 1:valider l'url
     * 
     * 2:Verifier si l'url a deja ete raccourci et le retourner si c'est le cas 
     * 
     * 3:creer une nouvelle short url et la retourner 
     * 
     * 4:Message de success
     */

    Validator::make($data, $rules);


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
