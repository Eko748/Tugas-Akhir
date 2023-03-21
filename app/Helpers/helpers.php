<?php

$routes = include('config/route_list.php');

function searchRoute($input)
{
    global $routes;
    $matches = [];

    foreach ($routes as $name => $route) {
        if (strpos($route, $input) !== false) {
            $matches[$name] = $route;
        }
    }

    return $matches;
}
