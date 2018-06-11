<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use JiraAPI\Model\Business\Jira;

//Request::setTrustedProxies(array('127.0.0.1'));
$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig', array());
})
->bind('homepage')
;

$app->get('/dashboard', function () use ($app) {

    $jira = new Jira();

    $sprint = $jira->getSprint();
    $issues = $jira->getIssues();

    return $app['twig']->render('index.html.twig', array(
        'sprint' => $sprint,
        'issues' => $issues,
    ));
});

$app->get('/maildone', function () use ($app) {
    $jira = new Jira();
    $doneIssues = $jira->getDoneIssueLinks();

        $message = (new Swift_Message('Link of da donez'))
            ->setFrom(array('stijn.deridder@tactics.be'))
            ->setTo(array('deridder.stijn93@gmail.com'))
            ->setBody('kijk, ne mail!');

        $app['mailer']->send($message);

    return 'Matieu zijn nieuw haar';
})->bind('maildone');

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
