<?php

// configure your app for the production environment

$app['twig.path'] = array(__DIR__.'/../templates');
$app['twig.options'] = array('cache' => __DIR__.'/../var/cache/twig');

$app->register(new \Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__ . '/../var/logs/silex_' . $app['env'] . '.log',
));

$app->register(new Silex\Provider\SessionServiceProvider());

$app['monolog']->pushHandler(new \Datalog\Handler\MainHandler($app, 'php://stdout'));
$app['monolog']->pushHandler(new \Datalog\Handler\ApplicationHandler($app));