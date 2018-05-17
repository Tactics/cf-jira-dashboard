<?php
declare(strict_types = 1);
namespace JiraAPI;

const OPEN = 'open';
const IN_PROGRESS = 'In Progress';
const REVIEW = 'Review';
const RESOLVED = 'Resolved';
const REOPENED = 'Reopened';
const CLOSED = 'Closed';


class IssueRepository
{
    private $issues;
    private $totalIssues;
    public function __construct(array $issues)
    {
        $this->issues = $issues;
        $this->totalIssues = $this->getTotalIssues();
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
        $toReviewIssues = array_filter($this->issues, function(Issue $var) { return ($var->getStateName() === REVIEW); });
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

    public function getTotalIssues(): int
    {
        $openIssues = $this->getOpenIssues();
        $inProgressIssues = $this->getInProgressIssues();
        $toReviewIssues = $this->getToReviewIssues();
        $doneIssues = $this->getDoneIssues();
        $closedIssues = $this->getClosedIssues();

        $totalIssues = 0;
        $totalIssues += count($openIssues);
        $totalIssues += count($inProgressIssues);
        $totalIssues += count($toReviewIssues);
        $totalIssues += count($doneIssues);
        $totalIssues += count($closedIssues);

        return $totalIssues;
    }

    public function getOpenIssuesPercentage(): float
    {
        return round(((count($this->getOpenIssues()) / $this->totalIssues) * 100), 2);
    }

    public function getInProgressIssuesPercentage(): float
    {
        return round(((count($this->getInProgressIssues()) / $this->totalIssues) * 100),2);
    }

    public function getToReviewIssuesPercentage(): float
    {
        return round(((count($this->getToReviewIssues()) / $this->totalIssues) * 100),2);
    }

    public function getDoneIssuesPercentage(): float
    {
        return round(((count($this->getDoneIssues()) / $this->totalIssues) * 100),2);
    }

    public function getClosedIssuesPercentage(): float
    {
        return round(((count($this->getClosedIssues()) / $this->totalIssues) * 100),2);
    }

    public function getIssues()
    {
        return $this->issues;
    }

}
