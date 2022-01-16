<?php

namespace App\Http\Controllers\Web\Site;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class SiteController extends Controller
{
    public function welcome()
    {
        return Inertia::render('Site/Welcome', [
            'canLogin'          => Route::has('login'),
            'canRegister'       => Route::has('register'),
            'laravelVersion'    => Application::VERSION,
            'phpVersion'        => PHP_VERSION,
        ]);
    }
}
