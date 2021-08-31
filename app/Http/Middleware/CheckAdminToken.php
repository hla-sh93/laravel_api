<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckAdminToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    use GeneralTrait;

    public function handle(Request $request, Closure $next)
    {
        $user=null;
        try{
            $user = JWTAuth::parseToken()->authenticate();
        }
        catch(\Exception $e){
            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return $this-> ErrMsg('E3001', 'INVALID_TOKEN');
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return $this-> ErrMsg('E3001', 'EXPIRED_TOKEN');
            } else{
                return $this-> ErrMsg('E3001', 'TOKEN_NOTFOUND');
            }
        }
        catch(\Throwable $e){
            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return $this-> ErrMsg('E3001', 'INVALID_TOKEN');
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return $this-> ErrMsg('E3001', 'EXPIRED_TOKEN');
            } else{
                return $this-> ErrMsg('E3001', 'TOKEN_NOTFOUND');
            }
        }

        if(!$user){
            return $this->ErrMsg('E3001', 'Unauthenticated');
        }
        return $next($request);
    }
}
