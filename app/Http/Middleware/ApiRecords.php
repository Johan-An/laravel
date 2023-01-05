<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ApiRecords
{

    const API_RECORD_TAG = 'api-record-tag';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $dateTag = date('Y-m-d');
        Cache::tags([self::API_RECORD_TAG, $dateTag])->increment($dateTag . ':' .$request->path());
        return $next($request);
    }
}
