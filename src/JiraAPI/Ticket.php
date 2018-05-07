<?php

namespace JiraAPI;


class Ticket extends Sprint
{
    private $title;
    private $shortInfo;
    private $status;
    private $link;
    private $assignee;

    public function __construct(string $name, string $goal, int $id, array $issues, string $title, string $shortInfo, string $status,
                                string $link, string $assignee)
    {
        parent::__construct($name, $goal, $id, $issues);
        $this->title = $title;
        $this->shortInfo = $shortInfo;
        $this->status = $status;
        $this->link = $link;
        $this->assignee;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getShortInfo()
    {
        return $this->shortInfo;
    }

    /**
     * @param string $shortInfo
     */
    public function setShortInfo($shortInfo)
    {
        $this->shortInfo = $shortInfo;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return mixed
     */
    public function getAssignee()
    {
        return $this->assignee;
    }

    /**
     * @param mixed $assignee
     */
    public function setAssignee($assignee)
    {
        $this->assignee = $assignee;
    }

}
