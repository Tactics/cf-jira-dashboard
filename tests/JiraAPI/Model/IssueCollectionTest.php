<?php
declare(strict_types=1);

namespace Tests\JiraAPI\Model;

use JiraAPI\Model\Data\IssueCollection;
use JiraAPI\Model\Entity\Issue;
use Tests\JiraAPI\ObjectMother\IssueCollectionMother;
use Tests\JiraAPI\ObjectMother\IssueMother;

class IssueCollectionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function can_add_an_issue_to_a_collection()
    {
        $collection = IssueCollectionMother::withoutIssues();

        self::assertEmpty($collection->getIssues());

        $collection->add(new Issue('123', 'CLEARFACTS-X', 'jira.com/CLEARFACTS-X', 'addable issues', 'Isaak', 'To review', 'feature', []));

        self::assertCount(1, $collection->getIssues());
    }

    /**
     * @test
     */
    public function can_fetch_all_issues_per_status()
    {
        $collection = IssueCollectionMother::withACollectionOfIssues();

        /** since our keys are not significant, we can compare to array_values */
        self::assertEquals(IssueMother::openBugs(), array_values($collection->getOpenIssues()));
        self::assertEquals(IssueMother::bugsInProgress(), array_values($collection->getInProgressIssues()));
        self::assertEquals(array_merge(IssueMother::bugsUpForReview(), IssueMother::featuresUpForReview()), array_values($collection->getToReviewIssues()));
        self::assertEquals(IssueMother::resolvedFeatures(), array_values($collection->getDoneIssues()));
        self::assertEquals(IssueMother::closedFeatures(), array_values($collection->getClosedIssues()));
    }

    /**
     * @test
     */
    public function get_representing_percentage_for_each_status()
    {
        $collection = IssueCollectionMother::withACollectionOfIssues();

        $this->assertEquals(14.29, $collection->getOpenIssuesPercentage());
        $this->assertEquals(14.29, $collection->getInProgressIssuesPercentage());
        $this->assertEquals(28.57, $collection->getToReviewIssuesPercentage());
        $this->assertEquals(28.57, $collection->getDoneIssuesPercentage());
        $this->assertEquals(14.29, $collection->getClosedIssuesPercentage());
    }

    /**
     * @test
     */
    public function will_return_zero_as_a_percent_when_no_issues_in_collection()
    {
        $collection = IssueCollectionMother::withoutIssues();

        $this->assertEquals(0, $collection->getOpenIssuesPercentage());
        $this->assertEquals(0, $collection->getInProgressIssuesPercentage());
        $this->assertEquals(0, $collection->getToReviewIssuesPercentage());
        $this->assertEquals(0, $collection->getDoneIssuesPercentage());
        $this->assertEquals(0, $collection->getClosedIssuesPercentage());
    }

    /**
     * @test
     */
    public function can_fetch_an_issue_by_its_id()
    {
        $collection = IssueCollectionMother::withACollectionOfIssues();

        $this->assertEquals(IssueMother::openBugs()[0], $collection->getIssueById('30'));
        $this->assertEquals(null, $collection->getIssueById('Not an Id'));
    }
}
