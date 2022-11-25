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
class RequestLog {


    /**
     * Handle an incoming request.
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {
        $requestReceiveTime = microtime(true);
        $requestData = array_merge($request->toArray(), ['start_time' => LARAVEL_START, 'end_time'=> $requestReceiveTime, 'duration'=> bcsub($requestReceiveTime,LARAVEL_START,6),'log_type'=>'request']);
        Log::info('request', $requestData);
        $response = $next($request);
        if ($response instanceof JsonResponse) {
            $responseEndTime=microtime(true);
            $responseData = array_merge($response->getData(true), ['start_time' => $requestReceiveTime, 'end_time'   => $responseEndTime,'duration'=> bcsub($responseEndTime,$requestReceiveTime,6), 'log_type'=>'response']);
            Log::info('response', $responseData);
        }
        return $response;
    }
}
