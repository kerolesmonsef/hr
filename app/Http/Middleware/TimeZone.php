<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TimeZone
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $comany_timezone = company_setting()['timezone'] ? company_setting()['timezone'] :'UTC';
        date_default_timezone_set($comany_timezone);
        return $next($request);
    }
}
