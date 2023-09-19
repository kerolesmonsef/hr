<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLang
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

        $lang = request()->header('lang') ?? session("lang") ?? auth()->user()?->lang ?? "ar";

        app()->setLocale($lang);

        return $next($request);

        // $lang = request()->header('lang') ?? session("lang") ?? "en";
        // if(session()->has('lang')){
        //     app()->setLocale(session()->get('lang'));
        // }else{
        //     app()->setLocale('en');
        // }
        // return $next($request);
    }
}
