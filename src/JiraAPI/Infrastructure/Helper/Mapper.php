<?php
declare(strict_types=1);

namespace JiraAPI\Infrastructure\Helper;

use JiraAPI\Model\Entity\Issue;
use JiraAPI\Model\Entity\Sprint;

/**
 * Class Mapper
 * @package JiraAPI
 */
class Mapper
{
    /**
     * @var Sprint
     */
    private $sprint;
    /**
     * @var array
     */
    private $sprintArray = [];
    /**
     * @var Issue[]
     */
    private $issues = [];

    /**
     * Mapper constructor.
     * @param array $sprintArray
     */
    public function __construct(array $sprintArray)
    {
        $this->sprintArray = $sprintArray;
        $this->makeNewSprint();
        $this->makeNewIssues();
    }

    /**
     * @return void
     */
    private function makeNewSprint(): void
    {
        $name = $this->sprintArray['sprintname'];
        $goal = $this->sprintArray['goal'];
        $id = $this->sprintArray['sprintId'];
        $this->sprint = new Sprint($id, $name, $goal);
    }

    /**
     * @return void
     */
    private function makeNewIssues(): void
    {
        foreach ($this->sprintArray['issues']['issues'] as $issue) {
            $id = $issue['id'];
            $key = $issue['key'];
            $link = 'http://jira.tactics.be:8080/browse/' . $key;
            $shortInfo = $issue['fields']['summary'];
            $assignee = $issue['fields']['assignee']['name'];
            $stateName = $issue['fields']['status']['name'];
            $customfields = $issue['fields']['customfield_11001'];
            $issuetype = $issue['fields']['issuetype']['name'];
            array_push($this->issues, new Issue($id, $key, $link, $shortInfo, $assignee, $stateName, $issuetype, $customfields));
        }
        asort($this->issues);
    }

    /**
     * @return Sprint
     */
    public function getSprint(): Sprint
    {
        return $this->sprint;
    }

    /**
     * @return array
     */
    public function getIssues(): array
    {
        return $this->issues;
    }

}