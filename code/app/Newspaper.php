<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newspaper extends Model
{
   	protected $fillable = [
        'name', 'link', 'thumbnail','infoDomain','totalArticles','totalViews','is_active','updateCount','added_by'
    ];
}
