<?php
declare(strict_types=1);

namespace Tests\JiraAPI\ObjectMother;

use JiraAPI\Model\Entity\Issue;

/**
 * Class IssueMother
 * @package tests\JiraAPI\ObjectMother
 */
class IssueMother
{
    /**
     * @return array
     */
    public static function openBugs(): array
    {
        return [
            new Issue('30', 'testissue-1', 'www.google.com', 'to the moon', 'Stijn', Issue::OPEN, 'bug', [])
        ];
    }

    /**
     * @return array
     */
    public static function resolvedFeatures(): array
    {
        return [
            new Issue('31', 'CLEARFACTS-2', 'www.gmail.com', 'and beyond', 'Freddy', Issue::RESOLVED, 'feature', []),
            new Issue('32', 'VDL-1', 'www.gmail.be', 'and even further', 'Bart', Issue::RESOLVED, 'feature', [])
        ];
    }

    /**
     * @return array
     */
    public static function bugsInProgress(): array
    {
        return [
            new Issue('33', 'testissue-4', 'www.hotmail.com', 'a long time ago', 'Mathieu', Issue::IN_PROGRESS, 'bug', []),

        ];
    }

    /**
     * @return array
     */
    public static function featuresUpForReview(): array
    {
        return [
            new Issue('34', 'testissue-5', 'www.msn.be', 'in a galaxy far far away', 'Jeroen', Issue::REVIEW, 'feature', [])
        ];
    }

    /**
     * @return array
     */
    public static function bugsUpForReview(): array
    {
        return [
            new Issue('35', 'testissue-6', 'www.yahoo.com', 'lived a piglet', 'Gijs', Issue::REVIEW, 'Resolved', [])
        ];
    }

    /**
     * @return array
     */
    public static function closedFeatures(): array
    {
        return [
            new Issue('36', 'testissue-7', 'www.outlook.com', 'it was a stray', 'Isaak', Issue::CLOSED, 'feature', [])
        ];
    }
}