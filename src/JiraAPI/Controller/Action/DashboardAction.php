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
     * @throws \JiraAPI\Exception\JiraException
     */
    public function execute(): void
    {
        $jira = new Jira();

        $sprint = $jira->getSprint();

        $this->response = [
            'sprint' => $sprint,
            'issueCollection' => $sprint->getIssueCollection()
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