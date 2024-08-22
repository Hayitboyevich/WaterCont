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
        'api/send-sms',
        'api/login',
        'api/users/create',
        'api/protocols/create',
        'api/protocols/edit',
        'api/protocols/reject',
        'api/protocols/confirm',
        'api/logout',
    ];
}
