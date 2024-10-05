<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        //dd("Qui authenticate.php");
        //return $request->expectsJson() ? null : route('login');
        if($request->expectsJson()){
            if($request->routeIs('admin.*')){
               session()->flash('fail','You must login first');
               return route('admin.login');
            } 
            if($request->routeIs('seller.*')){
                session()->flash('fail','You must login first');
                return route('seller.login');
            }
            if($request->routeIs('client.*')){
                session()->flash('fail','You must login first');
                return route('client.login');
            }  

        }
        
        if($request->routeIs('seller.*')){
            return route('seller.login');
        }
        if($request->routeIs('client.*')){
            return route('client.login');
        }
        return route('admin.login');
    }
}
