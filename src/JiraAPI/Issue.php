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
    private $customfieldsDoneChecked;

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
        $this->customfieldsDoneChecked = $this->allDoneCustomFieldsChecked();
    }

    public function allDoneCustomFieldsChecked()
    {
        if ($this->customfields === ""){
            return false;
        }
        $ar = [];
        foreach ($this->customfields as $customfield => $val) {
            $ar[$val['id']] = [$val['checked'], $val['name']];
        }
        //als alle vakjes zijn aangevinkt die aangevinkt moeten zijn om proper in done te staan, return true (voor filter op template)
        if (isset($ar['10200']) && $ar['10200'][0] && $ar['10201'][0] && $ar['10211'][0] && $ar['10202'][0] && $ar['10210'][0] && $ar['10203'][0] && $ar['10204'][0] && $ar['10205'][0]
            && $ar['10213'][0] && $ar['10209'][0] && $ar['10207'][0] && $ar['10206'][0] && $ar['10300'][0]) {
            return true;
        }
        return false;

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

    /**
     * @return mixed
     */
    public function getCustomfieldsDoneChecked():bool
    {
        return $this->customfieldsDoneChecked;
    }
}
