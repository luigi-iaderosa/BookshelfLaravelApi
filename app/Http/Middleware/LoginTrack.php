<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\LoginTable;
use App\Helpers\HelperClass;


class LoginTrack
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

        // before login is app-handled
        $columns = ['username','password'];
        $loginTrackValues = HelperClass::extractFromRequest($request,$columns);

        foreach ($columns as $value){
            if (!isset($loginTrackValues[$value])){
                throw new \Exception('field '+ $value+' not found');
            }
        }
        $loginTrackValues['attempt_time'] = date('Y-m-d H:i:s');
        LoginTable::create($loginTrackValues);
        return $next($request);
    }
}
