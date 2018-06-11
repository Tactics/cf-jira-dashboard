<?php
declare(strict_types=1);

namespace JiraAPI;

/**
 * Class Sprint
 * @package JiraAPI
 */
class Sprint
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $goal;

    public function __construct(int $id, string $name, string $goal)
    {
        $this->name = $name;
        $this->goal = $goal;
        $this->id = $id;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getGoal(): string
    {
        return $this->goal;
    }
}