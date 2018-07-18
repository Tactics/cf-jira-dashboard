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
     * @return array
     */
    public function getOpenIssues(): array
    {
        return array_filter($this->issues, function (Issue $var) {
            return ($var->getStatus() === Issue::OPEN) || ($var->getStatus() === Issue::REOPENED);
        });
    }

    /**
     * @return array
     */
    public function getInProgressIssues(): array
    {
        return array_filter($this->issues, function (Issue $var) {
            return ($var->getStatus() === Issue::IN_PROGRESS);
        });
    }

    /**
     * @return array
     */
    public function getToReviewIssues(): array
    {
        return array_filter($this->issues, function (Issue $var) {
            return ($var->getStatus() === Issue::REVIEW);
        });
    }

    /**
     * @return array
     */
    public function getDoneIssues(): array
    {
        return array_filter($this->issues, function (Issue $var) {
            return ($var->getStatus() === Issue::RESOLVED);
        });
    }

    /**
     * @return array
     */
    public function getClosedIssues(): array
    {
        return array_filter($this->issues, function (Issue $var) {
            return ($var->getStatus() === Issue::CLOSED);
        });
    }

    /**
     * @param string $id
     * @return Issue|null
     */
    public function getIssueById(string $id): ?Issue
    {
        $filtered = array_filter($this->issues, function (Issue $var) use ($id) {
            return ($var->getId() === $id);
        });

        return reset($filtered) ?: null;
    }

    /**
     * @return float
     */
    public function getOpenIssuesPercentage(): float
    {
        return $this->calculatePercentage($this->getOpenIssues());
    }

    /**
     * @return float
     */
    public function getInProgressIssuesPercentage(): float
    {
        return $this->calculatePercentage($this->getInProgressIssues());
    }

    /**
     * @return float
     */
    public function getToReviewIssuesPercentage(): float
    {
        return $this->calculatePercentage($this->getToReviewIssues());
    }

    /**
     * @return float
     */
    public function getDoneIssuesPercentage(): float
    {
        return $this->calculatePercentage($this->getDoneIssues());
    }

    /**
     * @return float
     */
    public function getClosedIssuesPercentage(): float
    {
        return $this->calculatePercentage($this->getClosedIssues());
    }

    /**
     * @param array $issues
     * @return float
     */
    private function calculatePercentage(array $issues): float
    {
        /** fallback for dividing by zero */
        if (0 === count($this->issues)){
            return 0;
        }

        return round(((count($issues) / count($this->issues)) * 100), 2);
    }
}
