<?php
declare(strict_types = 1);
namespace JiraAPI;

const OPEN = 'open';
const IN_PROGRESS = 'In Progress';
const TO_REVIEW = 'To Review';
const RESOLVED = 'Resolved';
const REOPENED = 'Reopened';
const CLOSED = 'Closed';


class IssueRepository
{
    private $issues;
    public function __construct(array $issues)
    {
        $this->issues = $issues;
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

    public function getIssueById($id): Issue
    {
        $filtered = array_filter($this->issues, function(Issue $var) use ($id) { return ($var->getId() === $id); } );
        return reset($filtered);
    }

}