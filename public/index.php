<?php
/* Bootstrap */
require __DIR__ . '/../bootstrap.php';

$router = new \Respect\Rest\Router();

$router->get('/tweets', function() {
	$twitter = new \Ehub\Consumer\Twitter();
	return $twitter->search('tnwlatam');
})->accept(array(
	'.json' => 'json_encode'
));

$router->get('/place/*', function($placeId) {
    $foursquare = new \Ehub\Consumer\Foursquare();
    return $foursquare->getPlace($placeId);
})->accept(array(
    'application/json' => 'json_encode'
));

$router->get('/', function() {
    new \Ehub\Views\ViewHandler('index.html');
});
