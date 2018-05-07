<?php
declare(strict_types=1);

namespace JiraAPI;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use GuzzleHttp\Client;

class APICallerService
{
    /*If you have a url and your php supports it, you could just call file_get_contents:

    $response = file_get_contents('http://example.com/path/to/api/call?param1=5');
    if $response is JSON, use json_decode to turn it into php array:

    $response = json_decode($response);
    if $response is XML, use simple_xml class:

    $response = new SimpleXMLElement($response);*/

    private $username;
    private $password;

    public function __construct($username, $password)
    {

        $this->username = $username;
        $this->password = $password;
    }

    public function getClearfactsSprint()
    {
        /**
         * Resource: Jira is considered the resource
         * Resource owner: Jira user
         * Consumer: User of the application
         * http://jira.tactics.be:8080/rest/agile/latest/board/1
         */

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

        $issues = $client->get('http://jira.tactics.be:8080/rest/agile/1.0/board/1/sprint/' . $sprintId .'/issue', [
            'auth' => [
                $this->username, $this->password
                //200 issues per request
            ]
        ]);

        $issues = json_decode($issues->getBody()->getContents(), true);
        $sprint = [
            'sprintname' => $sprintname,
            'goal' => $goal,
            'sprintId' => $sprintId,
            'issues' => $issues
        ];

        return $sprint;
    }
}