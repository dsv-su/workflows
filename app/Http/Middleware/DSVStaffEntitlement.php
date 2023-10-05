<?php

namespace App\Http\Middleware;

use App\Services\Settings\AuthHandler;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DSVStaffEntitlement
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
        $system = new AuthHandler();
        $system = $system->authorize();
        $auth_param = $system->global->authorization_parameter;
        //$authstring = $system->global->authorization; //For multiple entitlements
        $entitlement = $system->global->authorization;

        //$auth = explode(";", $authstring); //For multiple entitlements

        $match = 0;
        if(!$request->server('REMOTE_USER')) {
            //if($system->global->app_env == 'local' or Auth::check()) {
            if(Auth::check()) {
                return $next($request);
            }
        }
        else
        {
            $server = explode(";", $_SERVER[$auth_param]);
            //foreach ($auth as $entitlement)  //For multiple entitlements
            //{                                 //For multiple entitlements
            foreach($server as $server_entitlement)
            {
                if($entitlement == $server_entitlement)
                {
                    $match++;
                }
            }
            //} //For multiple entitlements
        }

        if ($match !== 1)
        {
            Auth::logout();
            abort(401);
        }

        return $next($request);
    }
}
