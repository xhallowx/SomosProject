<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    /**
     * The names of the attributes that should not be clipped.
     *
     * @var array
     */
    protected $except = [
        // Add the fields here that you do not want to crop
    ];
}
