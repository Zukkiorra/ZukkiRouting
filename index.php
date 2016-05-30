<?php
require 'php/System/Route.php';
require 'php/UserBundle/Controller/UserController.php';

$route = new Route();

$route->add("/login", "UserController", "getLoginForm");
$route->add("/loginUser", "UserController", "loginUser");

// echo "<pre>";
// print_r($route);

$route->submit();