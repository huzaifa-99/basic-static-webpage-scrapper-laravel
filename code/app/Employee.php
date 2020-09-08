<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
    	'Ename','EAge','ECity','E_Street','E_House','E_Basic_Salary','E_Bonus','E_Rank','E_Department'
    ];

}
