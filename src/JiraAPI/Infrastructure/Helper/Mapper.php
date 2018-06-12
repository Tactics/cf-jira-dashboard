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
     * @param array $response
     * @return Sprint
     */
    public function mapsToSprintFromResponse(array $response): Sprint
    {
        $name = $response['sprintname'];
        $goal = $response['goal'];
        $id = $response['sprintId'];
        $sprint = new Sprint($id, $name, $goal);

        $this->fillWithIssues($sprint, $response);

        return $sprint;
    }

    /**
     * @param Sprint $sprint
     * @param array $response
     * @return void
     */
    private function fillWithIssues(Sprint $sprint, array $response): void
    {
        foreach ($response['issues']['issues'] as $issue) {
            $issue = Issue::fromArray($issue);
            $sprint->addIssue($issue);
        }
    }
}