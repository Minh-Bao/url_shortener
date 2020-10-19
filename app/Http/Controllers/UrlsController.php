<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UrlsController extends Controller
{
    public function create() {
        return view('welcome');
    }

    public function store(Request $request) {

        $this->validate($request, ['url' => 'required|url']);

        $record = $this->getRecordForUrl($request->url);

        return view('result')->withShortened($record->shortened  ); 
    }

    public function show($shortened) {
        $url = Url::whereShortened($shortened)->first();

        if(! $url){
            return Redirect::to('/');
        }

        return Redirect::to($url->url);
    }

    private function getRecordForUrl($url) {
        $record = Url::whereUrl($url)->first(); 

        if($record) {                                     
            return $record; 
        }
        
        return Url::create([           
            'url' => $url,
            'shortened' => Url::getUniqueShortUrl(),
        ]);

        /*
        if($row) {
            return view('result')->withShortened($row->shortened  ); 
        }else{
            return view('error');
        }
        */
    }
}
