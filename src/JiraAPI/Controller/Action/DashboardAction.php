<?php
declare(strict_types=1);

namespace JiraAPI\Controller\Action;

use JiraAPI\Model\Business\Jira;

/**
 * Class DashboardAction
 * @package JiraAPI\Controller\Action
 */
class DashboardAction implements Action
{
    /**
     * @var array
     */
    private $response = [];

    /**
     * @return void
     */
    public function execute(): void
    {
        $jira = new Jira();

        $sprint = $jira->getSprint();
        $issues = $jira->getIssues();

        $this->response = [
            'sprint' => $sprint,
            'issues' => $issues
        ];
    }

    /**
     * @return array
     */
    public function getResponse(): array
    {
        return $this->response;
    }
}