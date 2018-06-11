<?php
declare(strict_types=1);

namespace JiraAPI\Model\Entity;

/**
 * Class Issue
 * @package JiraAPI
 */
class Issue
{
    const OPEN = 'open';
    const IN_PROGRESS = 'In Progress';
    const REVIEW = 'Review';
    const RESOLVED = 'Resolved';
    const REOPENED = 'Reopened';
    const CLOSED = 'Closed';

    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $key;
    /**
     * @var string
     */
    private $shortInfo;
    /**
     * @var string
     */
    private $link;
    /**
     * @var string
     */
    private $assignee;
    /**
     * @var string
     */
    private $status;
    /**
     * @var string
     */
    private $stateName;
    /**
     * @var string
     */
    private $type;
    /**
     * @var array
     */
    private $customfields;
    /**
     * @var bool
     */
    private $customfieldsDoneChecked;

    /**
     * Issue constructor.
     * @param string $id
     * @param string $key
     * @param string $link
     * @param string $shortInfo
     * @param string $assignee
     * @param string $stateName
     * @param string $type
     * @param array $customfields
     */
    public function __construct(string $id, string $key, string $link, string $shortInfo, string $assignee = null, string $stateName, string $type, array $customfields)
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

    /**
     * @return bool
     */
    public function allDoneCustomFieldsChecked(): bool
    {
        if (!$this->customfields) {
            return false;
        }
        $ar = [];
        foreach ($this->customfields as $customfield => $val) {
            $ar[$val['id']] = [$val['checked'], $val['name']];
        }

        //als alle vakjes zijn aangevinkt die aangevinkt moeten zijn om proper in done te staan, return true (voor filter op template)
        if ($ar['10200'][0] && $ar['10201'][0] && $ar['10211'][0] && $ar['10202'][0] && $ar['10210'][0] && $ar['10203'][0] && $ar['10204'][0] && $ar['10205'][0]
            && $ar['10213'][0] && $ar['10209'][0] && $ar['10207'][0] && $ar['10206'][0] && $ar['10300'][0]) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return string
     */
    public function getStateName(): string
    {
        return $this->stateName;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getShortInfo(): string
    {
        return $this->shortInfo;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @return string
     */
    public function getAssignee(): ?string
    {
        return $this->assignee;
    }

    /**
     * @return array
     */
    public function getCustomfields(): array
    {
        return $this->customfields;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return bool
     */
    public function getCustomfieldsDoneChecked(): bool
    {
        return $this->customfieldsDoneChecked;
    }
}
