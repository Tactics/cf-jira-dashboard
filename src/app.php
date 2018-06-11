<?php

use JiraAPI\Jira;
use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;

$config = require __DIR__ . '/../secrets/secrets.php';

$app = new Application();
$app->register(new Silex\Provider\RoutingServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app->register(new Silex\Provider\SwiftmailerServiceProvider());

$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...

    return $twig;
});

$app["api_caller_service"] = function() use ($app, $config) {
    return new Jira();
};

return $app;
