<?php

namespace App\Http\Middleware;

use App\Helpers\HelperClass;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


      $token = resolve('helper')->extractFromRequest($request,['Apitoken']);
      $userId = auth()->payload()->get('sub');
      if (!$userId){
          return json_encode(['error'=>'Unknown user or token expired!']);
      }


        return $next($request);
    }
}
