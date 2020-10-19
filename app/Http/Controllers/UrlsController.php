<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UrlsController extends Controller
{
    public function create() {
        return view('welcome');
    }

    public function store(Request $request) {
        $url = $request->url;

        $data = ['url' => $url];

        $this->validate($request, ['url' => 'required|url']);

        $record = Url::whereUrl($url)->first(); 
        if($record) {                                     
            return view('result')->with('shortened', $record->shortened  ); 
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
    }

    public function show($shortened) {
        $url = Url::whereShortened($shortened)->first();

        if(! $url){
            return Redirect::to('/');
        }

        return Redirect::to($url->url);
    }
}
