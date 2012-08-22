<?php

/* Bootstrap */
require __DIR__ . '/../bootstrap.php';

$router = new \Respect\Rest\Router();

$router->get('/tweets', function() {
    $twitter = new \Ehub\Consumer\Twitter();
    $twitter->search('tnwlatam');
});

$router->get('/', function() {
    new \Ehub\Views\ViewHandler('index.html');
});