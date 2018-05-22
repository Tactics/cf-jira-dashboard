<?php
declare(strict_types=1);

namespace JiraAPI;

class Mapper
{
    private $sprintArray = [];
    private $sprint;
    private $issues = [];
    public function __construct($sprintArray)
    {
        $this->sprintArray = $sprintArray;
        $this->makeNewSprint();
        $this->makeNewIssues();
    }

    private function makeNewSprint()
    {
        $name = $this->sprintArray['sprintname'];
        $goal = $this->sprintArray['goal'];
        $id = $this->sprintArray['sprintId'];
        $this->sprint = new Sprint($id, $name, $goal);
    }

    private function makeNewIssues()
    {
        foreach($this->sprintArray['issues']['issues'] as $issue)
        {
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