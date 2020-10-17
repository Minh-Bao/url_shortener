<?php

use App\Models\Url;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;


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

    /**
     * 1:valider l'url
     * 
     * 2:Verifier si l'url a deja ete raccourci et le retourner si c'est le cas 
     * 
     * 3:creer une nouvelle short url et la retourner 
     * 
     * 4:Message de success
     */

     //2
    $url = Url::whereUrl(request('url'))->first();

    if($url) {
        return view('result')->with('shortened', $url->shortened  ); 
        // revient a faire: return view('result')->withShortened($url->shortened );
        
    }
});

Route::get('/{shortened}', function ($shortened) {
    $url = Url::whereShortened($shortened)->first();

    if(! $url){
        return Redirect::to('/');
    }

    return Redirect::to($url->url);
});    
