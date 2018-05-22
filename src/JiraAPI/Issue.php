<?php

namespace JiraAPI;

class Issue
{
    private $id;
    private $key;
    private $shortInfo;
    private $link;
    private $assignee;
    private $status;
    private $stateName;
    private $type;
    private $customfields;
    public function __construct($id, $key, $link, $shortInfo, $assignee, $stateName, $type, $customfields)
    {
        $this->id = $id;
        $this->key = $key;
        $this->shortInfo = $shortInfo;
        $this->link = $link;
        $this->assignee = $assignee;
        $this->stateName = $stateName;
        $this->type = $type;
        $this->customfields = $customfields;
    }

    public function getStateName()
    {
        return $this->stateName;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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

    public function getCustomfields()
    {
        return $this->customfields;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
}
