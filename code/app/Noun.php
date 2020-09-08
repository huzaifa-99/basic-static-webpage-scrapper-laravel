<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noun extends Model
{
    protected $fillable = [
    	'article_id',
    	'noun'
    ];
}
