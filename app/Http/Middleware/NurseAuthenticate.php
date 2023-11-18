<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class NurseAuthenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('nurse.login');
        }
    }

    protected function authenticate($request, array $guards)
    {
        

        
            if ($this->auth->guard('nurse')->check()) {
                return $this->auth->shouldUse('nurse');
            }
       

        $this->unauthenticated($request, ['nurse']);
    }

}
