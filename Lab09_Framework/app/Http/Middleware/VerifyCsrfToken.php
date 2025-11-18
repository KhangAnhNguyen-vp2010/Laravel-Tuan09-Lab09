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
        //
    ];

    /**
     * Append URIs that should bypass CSRF verification at runtime.
     *
     * @param  array<int, string>  $uris
     * @return void
     */
    public function addExceptUris(array $uris): void
    {
        $this->except = array_values(array_unique(array_merge($this->except, $uris)));
    }
}
