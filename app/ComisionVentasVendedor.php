<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComisionVentasVendedor extends Model
{
    //
    public $timestamps = false;
    protected $fillable =['id_vendedor','id_veta','monto','date'];
}
