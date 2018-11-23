<?php

namespace App;

use Illuminate\Support\Facades\Route;

class RouteChecker
{
    public $route;

    public function __construct()
    {
        $this->route = Route::currentRouteName();
    }

    /**
     * Check if current route is equal to the given route
     *
     * @param  string  $routeName
     * @param  string  $output
     * @return boolean
     */
    public function isOnRoute($routeName, $returnClass = 'active')
    {   
        /* Check given route name */
        if(strpos($this->route, $routeName) !== false) {
            return $returnClass;
        }

        return strpos($routeName, $this->route);
    }

    /**
     * Check if current route is equal to the given array of route
     *
     * @param  array  $routeNames
     * @param  string  $output
     * @return boolean
     */
    public function isActive($routeNames, $returnClass = 'active')
    {
        if (is_array($routeNames)) {
            /* Check each route name on the given array */
            foreach($routeNames as $routeName) {
                if($this->isOnRoute($routeName, $returnClass)) {
                    return $returnClass;
                }
            }
        } else if (is_string($routeNames)) {
            if($this->isOnRoute($routeNames, $returnClass)) {
                return $returnClass;
            }
        }
        
        return $this->route;
    }
}