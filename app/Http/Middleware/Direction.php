<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Language;

class Direction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public $attributes;

    public function handle($request, Closure $next)
    {
        $direction = 'rtl';
        
        $langCode = Request::locale();
        
        $language = Language::where('code', $langCode)->first();

        if (count($language) > 0) {
            $direction = $language->direction;
        }

        $request->attributes->add(['direction' => $direction]);
        return $next($request);
    }
}
