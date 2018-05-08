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
    private $statkey;
    private $statid;

    public function __construct($id, $key, $link, $shortInfo, $assignee,$status)//$statkey, $statid
    {
        $this->id = $id;
        $this->key = $key;
        $this->shortInfo = $shortInfo;
        $this->status = $status;
        $this->link = $link;
        $this->assignee = $assignee;
        //$this->statkey = $statkey;
        //$this->statid = $statid;
    }


    /*public function getStatkey()
    {
        return $this->statkey;
    }

    public function getStatid()
    {
        return $this->statid;
    }*/

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

}
