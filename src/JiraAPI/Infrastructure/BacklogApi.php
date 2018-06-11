<?php
declare(strict_types=1);

namespace JiraAPI\Infrastructure;

use JiraAPI\Model\Data\IssueRepository;
use JiraAPI\Model\Entity\Sprint;

/**
 * Interface BacklogApi
 * @package JiraAPI
 */
interface BacklogApi
{
    /**
     * @return Sprint
     */
    public function getSprint(): Sprint;

    /**
     * @return IssueRepository
     */
    public function getIssues(): IssueRepository;
}