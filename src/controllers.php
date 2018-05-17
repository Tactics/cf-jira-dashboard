<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use JiraAPI\Mapper;
use JiraAPI\IssueRepository;
use JiraAPI\APICallerService;
//Request::setTrustedProxies(array('127.0.0.1'));

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig', array());
})
->bind('homepage')
;

$app->get('/dashboard', function () use ($app) {

    $jira = new APICallerService()/*$this->get('jira')*/;

    /** @var \JiraAPI\Sprint $sprint */
    $sprint = $jira->getSprint();
    /** @var IssueRepository $issues */
    $issues = $jira->getIssues();

    return $app['twig']->render('index.html.twig', array(
        'sprint' => $sprint,
        'issues' => $issues,
    ));

});

$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html.twig',
        'errors/'.substr($code, 0, 2).'x.html.twig',
        'errors/'.substr($code, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
