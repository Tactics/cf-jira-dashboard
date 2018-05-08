<?php
declare(strict_types=1);

namespace JiraAPI;
define(OPEN, 'open');
define(IN_PROGRESS,'In Progress');
define(TO_REVIEW, 'To Review');
define(RESOLVED, 'Resolved');
define(REOPENED, 'Reopened');
define(CLOSED, 'Closed');

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
            $stateName = $issue['fields']['status']['name'];

            array_push($this->issues, new Issue($id, $key, $link, $shortInfo, $assignee,$status, $statkey, $stateName));
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

    public function getOpenIssues(): ?array
    {
        $openIssues = array_filter($this->issues, function(Issue $var) { return ($var->getStateName() === OPEN) || ($var->getStateName() === REOPENED); });
        return $openIssues;
    }

    public function getInProgressIssues(): ?array
    {
        $inProgressIssues = array_filter($this->issues, function(Issue $var) { return ($var->getStateName() === IN_PROGRESS); });
        return $inProgressIssues;
    }

    public function getToReviewIssues(): ?array
    {
        $toReviewIssues = array_filter($this->issues, function(Issue $var) { return ($var->getStateName() === TO_REVIEW); });
        return $toReviewIssues;
    }
    public function getDoneIssues(): ?array
    {
        $doneIssues = array_filter($this->issues, function(Issue $var) { return ($var->getStateName() === RESOLVED); });
        return $doneIssues;
    }

    public function getClosedIssues(): ?array
    {
        $closedIssues = array_filter($this->issues, function(Issue $var) { return ($var->getStateName() === CLOSED); });
        return $closedIssues;
    }

    /**
     * @return array
     */
    public function getIssues(): array
    {
        return $this->issues;
    }

}