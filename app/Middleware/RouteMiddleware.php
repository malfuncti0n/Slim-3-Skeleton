<?php

namespace App\Middleware;
use App\Models\Audit;



class RouteMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
         //with zero we count guest
         $userid=(!$this->container->auth->check() ? 0 : $this->container->auth->user()->id);
         //get details from route
         $audit=new Audit;
         $audit->route=$_SERVER['REQUEST_URI'];
         $audit->method=$_SERVER['REQUEST_METHOD'];
         $audit->userid=$userid;
         //save the request to database
         $audit->save();

        //call next middleware
        $response = $next($request, $response);
        return $response;
    }
}