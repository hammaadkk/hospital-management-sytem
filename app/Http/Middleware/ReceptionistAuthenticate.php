<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class ReceptionistAuthenticate extends Middleware
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
            return route('rececptionist.login');
        }
    }
    protected function authenticate($request, array $guards)
    {
       
            if ($this->auth->guard('receptionist')->check()) {
                return $this->auth->shouldUse('receptionist');
            }
        

        $this->unauthenticated($request, ['receptionist']);
    }

}
