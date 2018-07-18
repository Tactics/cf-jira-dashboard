<?php
declare(strict_types=1);

namespace JiraAPI\Model\Business;

use GuzzleHttp\Client;
use JiraAPI\Exception\JiraException;
use JiraAPI\Infrastructure\BacklogApi;
use JiraAPI\Infrastructure\Helper\Mapper;
use JiraAPI\Model\Data\IssueCollection;
use JiraAPI\Model\Entity\Issue;
use JiraAPI\Model\Entity\Sprint;

/**
 * Class Jira
 * @package JiraAPI
 */
class Jira implements BacklogApi
{
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $password;
    /**
     * @var Sprint
     */
    private $sprint;

    /**
     * Jira constructor.
     * @throws JiraException
     */
    public function __construct()
    {
        $config = require __DIR__ . '/../../../../secrets/secrets.php';
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->getClearFactsSprint();
    }

    /**
     * @return Sprint
     */
    public function getSprint(): Sprint
    {
        return $this->sprint;
    }

    /**
     * @return IssueCollection
     */
    public function getIssues(): array
    {
        return $this->sprint->getIssueCollection();
    }

    /**
     * @return void
     * @throws JiraException
     */
    public function getClearFactsSprint(): void
    {
        try {
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

            $issues = $client->get('http://jira.tactics.be:8080/rest/agile/1.0/board/1/sprint/' . $sprintId . '/issue/', [
                'auth' => [
                    $this->username, $this->password
                    //50 issues per request
                ]
            ]);

            $issues = json_decode($issues->getBody()->getContents(), true);

            if ($issues['total'] > 50) {
                $issues100 = $client->get('http://jira.tactics.be:8080/rest/agile/1.0/board/1/sprint/' . $sprintId . '/issue?startAt=51', [
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

            $mapper = new Mapper();

            $this->sprint = $mapper->mapsToSprintFromResponse($sprint);

        } catch (\Exception $exception) {
            throw new JiraException('We could not create a sprint');
        }
    }
}
