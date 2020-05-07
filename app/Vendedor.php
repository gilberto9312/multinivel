<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    public $timestamps = false;
    //
    protected $fillable = ['id', 'nombres', 'cod_parent'];
}
