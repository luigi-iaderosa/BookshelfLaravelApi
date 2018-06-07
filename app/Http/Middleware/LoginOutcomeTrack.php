<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\LoginTable;
class LoginOutcomeTrack
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
        $response = $next($request);
         $content =  json_decode($response->original,true);

         $loginTableValues['username'] = $content['username'];
         $loginTableValues['password'] = isset($content['password']) ? $content['password'] : '';
         if ($loginTableValues['password'] == ''){
             $loginTableValues['outcome'] = true;
         }
         else {
             $loginTableValues['outcome'] = false;
         }
         $loginTableValues['attempt_time'] = date('Y-m-d H:i:s');
         LoginTable::create($loginTableValues);

        // do something
        return $response;

    }
}
