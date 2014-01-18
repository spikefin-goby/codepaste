<?php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;
$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => __DIR__ . '/../views',
));

$app->get('/', function() use($app) {
	return $app['twig']->render('codepaste/index.html.twig');
});


$app->get('/show/{hash}', function($hash) use ($app) {
	return $app['twig']->render('codepaste/show.html.twig');
});

$app->get('/hello/{name}', function($name) use ($app) {
	return 'Hello '.$app->escape($name);
});

$app->run();
