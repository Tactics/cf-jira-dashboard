<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use JiraAPI\Mapper;
use JiraAPI\IssueRepository;
//Request::setTrustedProxies(array('127.0.0.1'));

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig', array());
})
->bind('homepage')
;

$app->get('/dashboard', function () use ($app) {
    $result = $app['api_caller_service']->getClearfactsSprint();
    $mapper = new Mapper($result);

    $sprint = $mapper->getSprint();
    $issues = $mapper->getIssues();
    $issueRepository = new IssueRepository($issues);

    $openIssues = $issueRepository->getOpenIssues();
    $inProgressIssues = $issueRepository->getInProgressIssues();
    $toReviewIssues = $issueRepository->getToReviewIssues();
    $doneIssues = $issueRepository->getDoneIssues();
    $closedIssues = $issueRepository->getClosedIssues();

    $total = $issueRepository->getTotalIssues();
    $openIssuesPercentage = $issueRepository->getOpenIssuesPercentage($total);
    $inProgressIssuesPercentage = $issueRepository->getInProgressIssuesPercentage($total);
    $toReviewIssuesPercentage = $issueRepository->getToReviewIssuesPercentage($total);
    $doneIssuesPercentage = $issueRepository->getDoneIssuesPercentage($total);
    $closedIssuesPercentage = $issueRepository->getClosedIssuesPercentage($total);

    return $app['twig']->render('index.html.twig', array(
        'sprint' => $sprint,
        'issues' => $issues,

        'openIssues' => $openIssues,
        'inProgressIssues' => $inProgressIssues,
        'toReviewIssues' => $toReviewIssues,
        'doneIssues' => $doneIssues,
        'closedIssues' => $closedIssues,

        'openIssuesPercentage' => $openIssuesPercentage,
        'inProgressIssuesPercentage' => $inProgressIssuesPercentage,
        'toReviewIssuesPercentage' => $toReviewIssuesPercentage,
        'doneIssuesPercentage' => $doneIssuesPercentage,
        'closedIssuesPercentage' => $closedIssuesPercentage
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
