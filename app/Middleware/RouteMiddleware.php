<?php

namespace App\Middleware;
use App\Models\Audit;



class RouteMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        //with zero we count guest
        if(!$this->container->auth->check()){
            $userid=0;
        }else{
            $userid=$this->container->auth->user()->id;
        }
        //get details from route
         $route=$request->getAttribute('route');
         $audit=new Audit;
         $audit->route=$route->getName();
         $method=$route->getMethods();
         $audit->method=$method[0];
         $audit->userid=$userid;
        //save the request to database
         $audit->save();

        //call next middleware
        $response = $next($request, $response);
        return $response;
    }
}