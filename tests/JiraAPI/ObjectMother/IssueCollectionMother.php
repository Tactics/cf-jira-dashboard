<?php
declare(strict_types=1);

namespace Tests\JiraAPI\ObjectMother;

use JiraAPI\Model\Data\IssueCollection;

/**
 * Class IssueCollectionMother
 */
class IssueCollectionMother
{
    /**
     * @return IssueCollection
     */
    public static function withACollectionOfIssues(): IssueCollection
    {
        return new IssueCollection(array_merge(
            IssueMother::openBugs(),
            IssueMother::bugsInProgress(),
            IssueMother::bugsUpForReview(),
            IssueMother::featuresUpForReview(),
            IssueMother::resolvedFeatures(),
            IssueMother::closedFeatures()
        ));
    }
}