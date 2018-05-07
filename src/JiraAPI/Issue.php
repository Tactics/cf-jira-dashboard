<?php

namespace JiraAPI;

class Issue
{
    private $id;
    private $key;
    private $shortInfo;
    private $status;
    private $link;
    private $assignee;

    public function __construct($id, $key, $link, $status, $shortInfo, $assignee)
    {
        $this->id = $id;
        $this->key = $key;
        $this->shortInfo = $shortInfo;
        $this->status = $status;
        $this->link = $link;
        $this->assignee = $assignee;
    }


    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getShortInfo()
    {
        return $this->shortInfo;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @return mixed
     */
    public function getAssignee()
    {
        return $this->assignee;
    }



}
