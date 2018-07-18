<?php
declare(strict_types=1);

namespace JiraAPI\Model\Entity;

use JiraAPI\Model\Data\IssueCollection;

/**
 * Class Sprint
 * @package JiraAPI
 */
class Sprint
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $goal;
    /**
     * @var IssueCollection
     */
    private $issueCollection;

    public function __construct(int $id, string $name, string $goal)
    {
        $this->name = $name;
        $this->goal = $goal;
        $this->id = $id;
        $this->issueCollection = new IssueCollection([]);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getGoal(): string
    {
        return $this->goal;
    }

    /**
     * @return IssueCollection
     */
    public function getIssueCollection(): IssueCollection
    {
        return $this->issueCollection;
    }

    /**
     * @param Issue $issue
     */
    public function addIssue(Issue $issue): void
    {
        $this->issueCollection->add($issue);
    }
}