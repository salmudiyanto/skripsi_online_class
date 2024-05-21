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
       "http://127.0.0.1:8000/apijadwalsiswa",
       "http://127.0.0.1:8000/apikirimtugastext",
       "http://smpn2parepare.balconteach.my.id/apijadwalsiswa",
       "http://fandy1720221039.my.id/apiloginsiswa",
       "http://fandy1720221039.my.id/apikirimtugastext",
       "http://fandy1720221039.my.id/apikirimtugasfile",
       "http://fandy1720221039.my.id/apikirimkuistext",
       "http://fandy1720221039.my.id/apikirimkuisfile",
       "http://fandy1720221039.my.id/submitujian",
       "http://smpn2parepare.balconteach.my.id/apiloginsiswa",
       "https://smpn2parepare.balconteach.my.id/apiloginsiswa",
       "http://fandy1720221039.my.id/apijadwalsiswa",
       "http://fandy1720221039.my.id/apiloginsiswa",
       "https://fandy1720221039.my.id/apiloginsiswa",
    ];
}
