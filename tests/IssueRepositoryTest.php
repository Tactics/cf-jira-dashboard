<?php

use JiraAPI\IssueRepository;
use JiraAPI\Issue;

class IssueRepositoryTest extends \PHPUnit\Framework\TestCase
{
    private $issueRepository;
    public function setUp()
    {
        $issues = [
            new Issue(30, 'testissue-1', 'www.google.com', 'to the moon', 'Stijn', 'open', 'bug', ''),
            new Issue(31, 'testissue-2', 'www.gmail.com', 'and beyond', 'Freddy', 'Resolved', 'feature', ''),
            new Issue(32, 'testissue-3', 'www.gmail.be', 'and even further', 'Bart', 'Resolved', 'feature', ''),
            new Issue(33, 'testissue-4', 'www.hotmail.com', 'a long time ago', 'Mathieu', 'In Progress', 'bug', ''),
            new Issue(34, 'testissue-5', 'www.msn.be', 'in a galaxy far far away', 'Jeroen', 'Review', 'feature', ''),
            new Issue(35, 'testissue-6', 'www.yahoo.com', 'lived a piglet', 'Gijs', 'Review', 'Resolved', ''),
            new Issue(36, 'testissue-7', 'www.outlook.com', 'it was a stray', 'Isaak', 'Closed', 'feature', '')
        ];

        $this->issueRepository = new IssueRepository($issues);
    }

    /**
     * @test
     */
    public function get_total_issues_counts_all_possible_states()
    {
        $result = $this->issueRepository->getTotalIssues();
        $this->assertEquals(7, $result);
    }

    /**
     * @test
     */
    public function get_done_issues_link_returns_array_of_done_links()
    {
        $result = $this->issueRepository->getDoneIssueLinks();
        $this->assertEquals('www.gmail.com', $result[0]);
        $this->assertEquals('www.gmail.be', $result[1]);
    }

    /**
     * @test
     */
    public function get_open_issues_percentage_returns_float_of_opened_and_reopened_issues()
    {
        $result = $this->issueRepository->getOpenIssuesPercentage();
        $this->assertEquals(14.29, $result);
    }

    /**
     * @test
     */
    public function get_in_progress_issues_percentage_returns_float()
    {
        $result = $this->issueRepository->getInProgressIssuesPercentage();
        $this->assertEquals(14.29, $result);
    }

    /**
     * @test
     */
    public function get_to_review_issues_percentage_returns_float()
    {
        $result = $this->issueRepository->getToReviewIssuesPercentage();
        $this->assertEquals(28.57, $result);
    }

    /**
     * @test
     */
    public function get_done_issues_percentage_returns_float()
    {
        $result = $this->issueRepository->getDoneIssuesPercentage();
        $this->assertEquals(28.57, $result);
    }

    /**
     * @test
     */
    public function get_closed_issues_percentage_returns_float()
    {
        $result = $this->issueRepository->getClosedIssuesPercentage();
        $this->assertEquals(14.29, $result);
    }
}
