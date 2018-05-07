<?php
/**
 * Created by PhpStorm.
 * User: deridstijn
 * Date: 5/7/18
 * Time: 10:11 AM
 */

namespace JiraAPI;


class Sprint
{
    private $name;
    private $goal;
    private $id;
    private $issues = [];

    public function __construct(string $name, string $goal, int $id, array $issues)
    {
        $this->name = $name;
        $this->goal = $goal;
        $this->id = $id;
        $this->issues = $issues;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name) : string
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getGoal() : string
    {
        return $this->goal;
    }

    /**
     * @param string $goal
     */
    public function setGoal($goal) : string
    {
        $this->goal = $goal;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id) : int
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function getIssues() : array
    {
        return $this->issues;
    }

    /**
     * @param array $issues
     */
    public function setIssues($issues) : array
    {
        $this->issues = $issues;
    }


}