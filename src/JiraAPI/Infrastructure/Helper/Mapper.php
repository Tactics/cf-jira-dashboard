<?php
declare(strict_types=1);

namespace JiraAPI\Infrastructure\Helper;

use JiraAPI\Model\Entity\Issue;
use JiraAPI\Model\Entity\Sprint;

/**
 * Class Mapper
 * @package JiraAPI
 */
class Mapper
{
    /**
     * @var array
     */
    private $sprintArray = [];

    /**
     * Mapper constructor.
     * @param array $sprintArray
     */
    public function __construct(array $sprintArray)
    {
        $this->sprintArray = $sprintArray;
    }

    /**
     * @return Sprint
     */
    public function makeNewSprint(): Sprint
    {
        $name = $this->sprintArray['sprintname'];
        $goal = $this->sprintArray['goal'];
        $id = $this->sprintArray['sprintId'];
        $sprint = new Sprint($id, $name, $goal);

        $this->fillWithIssues($sprint);

        return $sprint;
    }

    /**
     * @param Sprint $sprint
     * @return void
     */
    private function fillWithIssues(Sprint $sprint): void
    {
        foreach ($this->sprintArray['issues']['issues'] as $issue) {
            $issue = Issue::fromArray($issue);
            $sprint->addIssue($issue);
        }
    }
}