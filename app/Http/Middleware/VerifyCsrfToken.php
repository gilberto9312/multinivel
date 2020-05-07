<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'http://localhost/new-ml/public/index.php/vendedor-create',
        'http://localhost/new-ml/public/index.php/ventas-create',
        'http://localhost/new-ml/public/index.php/comision-vendedor'
    ];
}
