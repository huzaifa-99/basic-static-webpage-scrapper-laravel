<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $fillable=[
    	'name',
    	'info',
    	'pictures',
    	'thumbnail',
    	'cardInfo',
    	'profileViews',
    	'appearedIn',
    	'is_active',
    	'added_by',
    	'updateCount'
    ];
}
