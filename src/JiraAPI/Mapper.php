<?php

namespace JiraAPI;
use JiraAPI\Sprint;
use JiraAPI\Issue;

class Mapper
{
    private $sprintArray = [];
    private $sprint;
    private $issues;
    public function __construct($sprintArray)
    {
        $this->sprintArray = $sprintArray;
    }

    public function makeNewSprint()
    {
        $name = $this->sprintArray['sprintname'];
        $goal = $this->sprintArray['goal'];
        $id = $this->sprintArray['sprintId'];

        $this->sprint = new Sprint($id, $name, $goal);
    }

    public function makeNewIssues()
    {
        foreach($this->sprintArray['issues']['issues'] as $issue)
        {
            $id = $issue['id'];
            $key = $issue['key'];
            $link = 'http://jira.tactics.be:8080/browse/' . $key;
            $status = $issue['fields']['status']['statusCategory']['name'];
            $shortInfo = $issue['fields']['summary'];
            $assignee = $issue['fields']['assignee']['name'];

            array_push($this->issues, new Issue($id, $key, $link, $status, $shortInfo, $assignee));
        }
    }

    public function getIssueKey($id)
    {
        var_dump($this->issues[][$id]) ;
    }

    public function getSprintName(): string
    {
        return $this->sprint->getName();
    }

    public function getSprintGoal(): string
    {
        return $this->sprint->getGoal();
    }

    public function getSprintId(): int
    {
        return $this->sprint->getId();
    }


}