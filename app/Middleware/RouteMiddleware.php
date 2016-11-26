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
         $route=$request->getAttribute('route');
         $audit=new Audit;
//         var_dump($route);
//        die();
         $audit->route=($route ? $route->getName() : 'urlNotFound');
         $method=($route ? $route->getMethods() :array('methodUnkown'));
         $audit->method=$method[0];
         $audit->userid=$userid;
         //save the request to database
         $audit->save();

        //call next middleware
        $response = $next($request, $response);
        return $response;
    }
}