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
            $status = $issue['fields']['status']['statusCategory']['name'];
            $statkey = $issue['fields']['status']['statusCategory']['key'];
            $statid = $issue['fields']['status']['id'];

            array_push($this->issues, new Issue($id, $key, $link, $shortInfo, $assignee,$status, $statkey, $statid));
        }
    }

    public function getIssueById($id): Issue
    {
        $filtered = array_filter($this->issues, function(Issue $var) use ($id) { return ($var->getId() === $id); } );
        return reset($filtered);
    }

    public function getSprint(): Sprint
    {
        return $this->sprint;
    }

    public function getToDoIssues(): ?array
    {
        $toDos = array_filter($this->issues, function(Issue $var) { return ($var->getStatus() === 'To Do'); });
        return $toDos;
    }

    public function getInProgress(): ?array
    {
        $inProgress = array_filter($this->issues, function(Issue $var) { return ($var->getStatus() === 'In Progress'); });
        return $inProgress;
    }

    public function getDone(): ?array
    {
        $done = array_filter($this->issues, function(Issue $var) { return ($var->getStatus() === 'Done'); });
        return $done;
    }

    public function getWaitingForValidation(): ?array
    {
        $waitingForValidation = array_filter($this->issues, function(Issue $var) { return ($var->getStatus() === 'Waiting For Validation'); });
        return $waitingForValidation;
    }

    public function getInProduction(): ?array
    {
        $inProduction = array_filter($this->issues, function(Issue $var) { return ($var->getStatus() === 'In Production'); });
        return $inProduction;
    }
    /**
     * @return array
     */
    public function getIssues(): array
    {
        return $this->issues;
    }

}