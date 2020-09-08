<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'newspaper_id',
        'title',
        'excerpt',
        'body',
        'thumbnail',
        'link',
        'publisher',
        'published_on',

        
        'views',
        'polarity',
        'is_active',
        'added_by',
        'updateCount',
        'ratedFor',
    ];
}
