<?php

require 'vendor/autoload.php';



$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

match([$method, $uri]) {
    ['GET', '/'] => (new \App\Controller)->renderForm(),
    ['POST', '/register'] => (new \App\Controller)->register(),
    default => (new \App\Controller)->notFound()
};