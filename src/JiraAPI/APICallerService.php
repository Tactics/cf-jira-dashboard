<?php
declare(strict_types=1);

namespace JiraAPI;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use GuzzleHttp\Client;

class APICallerService implements BacklogApi
{
    public function getSprint(): Sprint
    {
        return $this->mapper->getSprint();
    }

    public function getIssues(): IssueRepository
    {
        $issues = $this->mapper->getIssues();
        return new IssueRepository($issues);
    }

    /*If you have a url and your php supports it, you could just call file_get_contents:

    $response = file_get_contents('http://example.com/path/to/api/call?param1=5');
    if $response is JSON, use json_decode to turn it into php array:

    $response = json_decode($response);
    if $response is XML, use simple_xml class:

    $response = new SimpleXMLElement($response);*/

    private $username;
    private $password;
    private $mapper;

    public function __construct(/*$username, $password*/)
    {
        $config = require __DIR__ . '/../../secrets/secrets.php';
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->getClearfactsSprint();
    }

    public function getClearfactsSprint()
    {
        /**
         * Resource: Jira is considered the resource
         * Resource owner: Jira user
         * Consumer: User of the application
         * http://jira.tactics.be:8080/rest/agile/latest/board/1
         */

        //@todo: Try catch voor wanneer er geen active sprint is
        $client = new Client();
        $latestSprint = $client->get('http://jira.tactics.be:8080/rest/agile/latest/board/1/sprint?state=active', [
            'auth' => [
                $this->username, $this->password
                            ]
        ]);
        $latestSprint = json_decode($latestSprint->getBody()->getContents(), true);
        $latestSprint = $latestSprint['values'][0];
        $sprintname = $latestSprint['name'];
        $goal = $latestSprint['goal'];
        $sprintId = $latestSprint['id'];

        $issues = $client->get('http://jira.tactics.be:8080/rest/agile/1.0/board/1/sprint/' . $sprintId .'/issue/', [
            'auth' => [
                $this->username, $this->password
                //50 issues per request
            ]
        ]);

        $issues = json_decode($issues->getBody()->getContents(), true);

        if ($issues['total'] > 50)
        {
            $issues100 = $client->get('http://jira.tactics.be:8080/rest/agile/1.0/board/1/sprint/' . $sprintId .'/issue?startAt=51', [
                'auth' => [
                    $this->username, $this->password
                    //50 issues per request
                ]
            ]);
            $issues100 = json_decode($issues100->getBody()->getContents(), true);

            $issues['issues'] = array_merge($issues['issues'], $issues100['issues']);

        }
        $sprint = [
            'sprintname' => $sprintname,
            'goal' => $goal,
            'sprintId' => $sprintId,
            'issues' => $issues
        ];

        $this->mapper = new Mapper($sprint);
    }
}
