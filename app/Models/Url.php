<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Url extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['url', 'shortened'];


    public static function getUniqueShortUrl() {
        $shortened = Str::random(5);

        if(static::whereShortened($shortened)->count() != 0) {
            return static::getUniqueShortUrl();
        } 
        return $shortened;
    }

}
