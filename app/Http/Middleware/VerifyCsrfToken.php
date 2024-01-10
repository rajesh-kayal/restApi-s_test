<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'http://127.0.0.1:1234/api/users/add',
        'http://127.0.0.1:1234/api/users/*',
        'http://127.0.0.1:1234/api/users/edit/*',
        'http://127.0.0.1:1234/api/users/delete/*'
    ];
}
