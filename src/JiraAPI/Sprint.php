<?php

namespace JiraAPI;


class Sprint
{
    private $name;
    private $goal;
    private $id;

    public function __construct(int $id, string $name, string $goal)
    {
        $this->name = $name;
        $this->goal = $goal;
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getGoal(): string
    {
        return $this->goal;
    }

    public function getId(): int
    {
        return $this->id;
    }

}