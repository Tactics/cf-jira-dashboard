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
     * @var IssueCollection
     */
    private $issueCollection;

    /**
     * @test
     */
    public function can_add_an_issue_to_a_collection()
    {
        $collection = new IssueCollection([]);

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

        self::assertEquals(IssueMother::openBugs(), $collection->getOpenIssues());
    }

    /**
     * @test
     */
    public function get_open_issues_percentage_returns_float_of_opened_and_reopened_issues()
    {
        $result = $this->issueCollection->getOpenIssuesPercentage();
        $this->assertEquals(14.29, $result);
    }

    /**
     * @test
     */
    public function get_in_progress_issues_percentage_returns_float()
    {
        $result = $this->issueCollection->getInProgressIssuesPercentage();
        $this->assertEquals(14.29, $result);
    }

    /**
     * @test
     */
    public function get_to_review_issues_percentage_returns_float()
    {
        $result = $this->issueCollection->getToReviewIssuesPercentage();
        $this->assertEquals(28.57, $result);
    }

    /**
     * @test
     */
    public function get_done_issues_percentage_returns_float()
    {
        $result = $this->issueCollection->getDoneIssuesPercentage();
        $this->assertEquals(28.57, $result);
    }

    /**
     * @test
     */
    public function get_closed_issues_percentage_returns_float()
    {
        $result = $this->issueCollection->getClosedIssuesPercentage();
        $this->assertEquals(14.29, $result);
    }
}
