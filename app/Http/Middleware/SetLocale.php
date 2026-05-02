<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $available = array_keys(config('site.locales', []));
        $locale = $request->query('lang');

        if (is_string($locale) && in_array($locale, $available, true)) {
            session(['locale' => $locale]);
            App::setLocale($locale);
        } elseif (is_string(session('locale')) && in_array(session('locale'), $available, true)) {
            App::setLocale(session('locale'));
        } else {
            App::setLocale(config('site.default_locale', config('app.locale')));
        }

        return $next($request);
    }
}
