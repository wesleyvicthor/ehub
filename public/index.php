<?php

/* Bootstrap */
require __DIR__ . '/../bootstrap.php';

$router = new \Respect\Rest\Router();

$router->get('/tweets', function() {
	$twitter = new \Ehub\Consumer\Twitter();
	$twitter->search('tnwlatam');
});