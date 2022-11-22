<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

/**
 * 全局上下文
 * Class UniContext
 * @package App\Http\Middleware
 */
class RequestLog
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
        Log::info('request',['data'=>$request->toArray()]);
        $response=$next($request);
        if($response instanceof JsonResponse){
            Log::info('response',['data'=>$response->getData(true)]);
        }
        return  $response;
    }
}
