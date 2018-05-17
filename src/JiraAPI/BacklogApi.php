<?php
declare(strict_types=1);

namespace JiraAPI;


interface BacklogApi
{

    public function getSprint(): Sprint;

    public function getIssues(): IssueRepository;
}