<?php
declare(strict_types=1);

namespace tests\JiraAPI\Infrastructure;

use JiraAPI\Infrastructure\Helper\Mapper;
use Tests\JiraAPI\ObjectMother\APIResponse;

class MapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function map_return_a_newly_created_sprint_instance()
    {
        $mapper = new Mapper();
        $sprint = $mapper->mapsToSprintFromResponse(APIResponse::currentSprintWith2Issues());

        self::assertEquals('SPRINT 16-4', $sprint->getName());
        self::assertEquals('the moon', $sprint->getGoal());
        self::assertEquals('485', $sprint->getId());
    }

    /**
     * @test
     */
    public function mapper_can_make_multiple_issues_from_the_sprint_array()
    {
        $mapper = new Mapper();
        $sprint = $mapper->mapsToSprintFromResponse(APIResponse::currentSprintWith2Issues());

        self::assertCount(2, $sprint->getIssueCollection()->getIssues());
    }
}
