<?php
declare(strict_types=1);

namespace JiraAPI\Model\Data;

use JiraAPI\Model\Entity\Issue;

/**
 * Class IssueCollection
 * @package JiraAPI
 */
class IssueCollection
{
    /**
     * @var Issue[]
     */
    private $issues;

    /**
     * IssueCollection constructor.
     * @param array $issues
     */
    public function __construct(array $issues)
    {
        $this->issues = $issues;
    }

    /**
     * @return array|Issue[]
     */
    public function getIssues()
    {
        return $this->issues;
    }

    /**
     * @param Issue $issue
     * @return bool
     */
    public function add(Issue $issue)
    {
        $this->issues[] = $issue;

        return true;
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
     * @return float
     */
    public function getOpenIssuesPercentage(): float
    {
        return round(((count($this->getOpenIssues()) / count($this->issues)) * 100), 2);
    }

    /**
     * @return float
     */
    public function getInProgressIssuesPercentage(): float
    {
        return round(((count($this->getInProgressIssues()) / count($this->issues)) * 100), 2);
    }

    /**
     * @return float
     */
    public function getToReviewIssuesPercentage(): float
    {
        return round(((count($this->getToReviewIssues()) / count($this->issues)) * 100), 2);
    }

    /**
     * @return float
     */
    public function getDoneIssuesPercentage(): float
    {
        return round(((count($this->getDoneIssues()) / count($this->issues)) * 100), 2);
    }

    /**
     * @return float
     */
    public function getClosedIssuesPercentage(): float
    {
        return round(((count($this->getClosedIssues()) / count($this->issues)) * 100), 2);
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
