<?php

namespace App\Http\Middleware;

use App\Http\Traits\ApiResponseTrait;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    use ApiResponseTrait;
    public function handle(Request $request, Closure $next)
    {

        try {

            $user=JWTAuth::parseToken()->authenticate();
        }catch (Exception $e){
            if ($e instanceof TokenInvalidException){
                return $this->apiResponse(422,"token invalid");
            }
            elseif ($e instanceof TokenExpiredException)
            {
                return $this->apiResponse(422,"Token is Expired");
            }
            else
            {
                return $this->apiResponse(422,"Authorization Token  Not Found");
            }
        }
        return $next($request);
    }
}
