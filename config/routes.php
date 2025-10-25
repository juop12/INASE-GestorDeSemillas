<?php
use Cake\Routing\RouteBuilder;

return function (RouteBuilder $routes): void {
    $routes->setRouteClass('DashedRoute');

    $routes->scope('/', function (RouteBuilder $builder): void {
        $builder->connect('/', ['controller' => 'Samples', 'action' => 'index']);
        
        $builder->fallbacks();
    });
};
