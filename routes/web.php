<?php
/**
 * @var \Laravel\Lumen\Routing\Router $router
 */

$router->get("a/{thing}[/{lang}]", "OneController@get");
$router->get('generator/{thing}', "GeneratorController@get");
