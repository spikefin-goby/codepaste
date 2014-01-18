<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use KzykHys\Pygments\Pygments;

$app = new Silex\Application();
$app['debug'] = true;
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../views',
));

/**
 * index
 */
$app->get('/', function () use ($app) {
    return $app['twig']->render('codepaste/index.html.twig');
});

/**
 * code paste
 */
$app->post('/paste', function (Request $request) use ($app) {
    $code = $request->get('code');
    if (!$code) {
        return new Response('Missing parameters.', 400);
    }

    $hash = md5($code);
    

});

/**
 * code show
 */
$app->get('/show/{hash}', function ($hash) use ($app) {
    $pygments = new Pygments();
    $code = file_get_contents('/Users/hirose/github/codepaste/webroot/index.php');
    $code_highlight = $pygments->highlight($code, null, 'html', array('linenos' => 1));

    return $app['twig']->render('codepaste/show.html.twig', array(
        'code_highlight' => $code_highlight,
    ));
});

$app->run();
