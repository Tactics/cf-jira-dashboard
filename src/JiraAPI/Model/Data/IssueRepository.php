<?php
declare(strict_types=1);

namespace JiraAPI\Model\Data;

use JiraAPI\Model\Entity\Issue;

/**
 * Class IssueRepository
 * @package JiraAPI
 */
class IssueRepository
{
    /**
     * @var Issue[]
     */
    private $issues;
    /**
     * @var int
     */
    private $totalIssues;

    /**
     * IssueRepository constructor.
     * @param array $issues
     */
    public function __construct(array $issues)
    {
        $this->issues = $issues;
        $this->totalIssues = $this->getTotalIssues();
    }

    /**
     * @return array|null
     */
    public function getOpenIssues(): ?array
    {
        $openIssues = array_filter($this->issues, function (Issue $var) {
            return ($var->getStateName() === Issue::OPEN) || ($var->getStateName() === Issue::REOPENED);
        });

        return $openIssues;
    }

    /**
     * @return array|null
     */
    public function getInProgressIssues(): ?array
    {
        $inProgressIssues = array_filter($this->issues, function (Issue $var) {
            return ($var->getStateName() === Issue::IN_PROGRESS);
        });

        return $inProgressIssues;
    }

    /**
     * @return array|null
     */
    public function getToReviewIssues(): ?array
    {
        $toReviewIssues = array_filter($this->issues, function (Issue $var) {
            return ($var->getStateName() === Issue::REVIEW);
        });

        return $toReviewIssues;
    }

    /**
     * @return array|null
     */
    public function getDoneIssues(): ?array
    {
        $doneIssues = array_filter($this->issues, function (Issue $var) {
            return ($var->getStateName() === Issue::RESOLVED);
        });

        return $doneIssues;
    }

    /**
     * @return array|null
     */
    public function getClosedIssues(): ?array
    {
        $closedIssues = array_filter($this->issues, function (Issue $var) {
            return ($var->getStateName() === Issue::CLOSED);
        });

        return $closedIssues;
    }

    /**
     * @param int $id
     * @return Issue
     */
    public function getIssueById(int $id): Issue
    {
        $filtered = array_filter($this->issues, function (Issue $var) use ($id) {
            return ($var->getId() === $id);
        });

        return reset($filtered);
    }

    /**
     * @return int
     */
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

    /**
     * @return float
     */
    public function getOpenIssuesPercentage(): float
    {
        return round(((count($this->getOpenIssues()) / $this->totalIssues) * 100), 2);
    }

    /**
     * @return float
     */
    public function getInProgressIssuesPercentage(): float
    {
        return round(((count($this->getInProgressIssues()) / $this->totalIssues) * 100), 2);
    }

    /**
     * @return float
     */
    public function getToReviewIssuesPercentage(): float
    {
        return round(((count($this->getToReviewIssues()) / $this->totalIssues) * 100), 2);
    }

    /**
     * @return float
     */
    public function getDoneIssuesPercentage(): float
    {
        return round(((count($this->getDoneIssues()) / $this->totalIssues) * 100), 2);
    }

    /**
     * @return float
     */
    public function getClosedIssuesPercentage(): float
    {
        return round(((count($this->getClosedIssues()) / $this->totalIssues) * 100), 2);
    }

    /**
     * @return array|Issue[]
     */
    public function getIssues()
    {
        return $this->issues;
    }

    /**
     * @return array
     */
    public function getDoneIssueLinks()
    {
        $doneIssues = $this->getDoneIssues();
        $links = [];
        foreach ($doneIssues as $issue) {
            array_push($links, $issue->getLink());
        }

        return $links;
    }

}
