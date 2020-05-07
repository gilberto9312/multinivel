<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentasVendedor extends Model
{
    public $timestamps = false;
    //
    protected $fillable = ['id_vendedor','monto','date'];
}
