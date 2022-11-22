<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Facades\Response;

/**
 * JWT TOKEN 校验
 * Class JwtAuthCatch
 * @package App\Http\Middleware
 */
class JwtAuthCatch
{
    /**
     * JWT
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token=$request->bearerToken();
        if(!$token){
            return Response::errorUnauthorized('token不能为空');
        }
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return Response::errorUnauthorized($e->getMessage());
        }
        return $next($request);
    }
}
