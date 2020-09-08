<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Polarity extends Model
{
    protected $fillable = [
    	'article_id',
    	'system',
	    'positive',
	    'negative',
	    'neutral',
	    'is_active',
	    'updateCount'
	];
}
