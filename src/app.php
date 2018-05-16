<?php

use JiraAPI\APICallerService;
use JiraAPI\IssueServiceProvider;
use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;

$config = require __DIR__ . '/../secrets/secrets.php';

$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider(), array(
    'assets.version' => 'v1',
    'assets.version_format' => '%s?version=%s',
    'assets.named_packages' => array(
      'css' => array(
          'base_path' => __DIR__ . '/web/css'
      ),
    ),
));
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...

    return $twig;
});

$app["api_caller_service"] = function() use ($app, $config) {
    return new APICallerService($config['username'], $config['password']);
};

return $app;
