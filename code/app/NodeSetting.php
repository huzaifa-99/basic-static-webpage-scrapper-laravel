<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NodeSetting extends Model
{
    protected $fillable=['newspaper_id','article','link','title','body','thumbnail','publisher','published_on'];
}
