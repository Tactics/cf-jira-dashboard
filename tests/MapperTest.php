<?php

use JiraAPI\Mapper;

class MapperTest extends \PHPUnit\Framework\TestCase
{
    private $mapper;
    private $sprintArray =[];
    public function setUp()
    {
        $this->sprintArray = [
            'sprintname' => 'SPRINT 16-4',
            'goal' => 'the moon',
            'sprintId' => 485,
            'issues' => [
                'issues'
                   => [
                       [
                           'key' => 'Testissue-255',
                           'id' => 30,
                           'fields' => [
                               'status' => [
                                   'statusCategory' => [
                                       'name' => 'Waiting for validation'
                                   ]
                               ],

                                   'summary' => 'een heel cool test issue'
                               ,

                                   'assignee' => [
                                       'name' => 'Joske'
                                   ]

                           ]
                       ],
                        [
                            'key' => 'Testissue-256',
                            'id' => 40,
                            'fields' => [
                               'status' => [
                                   'statusCategory' => [
                                       'name' => 'To Do'
                                   ]
                               ],

                                   'summary' => 'een iets minder cool test issue'
                               ,

                                   'assignee' => [
                                       'name' => 'Jefke'

                               ]
                            ]
                        ]

                    ]
                ]
        ];

        $this->mapper = new Mapper($this->sprintArray);
    }


    /**
     * @test
     */
    public function mapper_can_make_a_new_sprint_from_the_sprint_array()
    {
        $this->mapper->makeNewSprint();
        $sprintNameResult = $this->mapper->getSprintName();
        $sprintGoalResult = $this->mapper->getSprintGoal();
        $sprintIdResult = $this->mapper->getSprintId();

        $this->assertEquals('SPRINT 16-4', $sprintNameResult);
        $this->assertEquals('the moon', $sprintGoalResult);
        $this->assertEquals('485', $sprintIdResult);

    }

    /**
     * @test
     */
    public function mapper_can_make_multiple_issues_from_the_sprint_array()
    {
        $this->mapper->makeNewIssues();
        $issue1 = $this->mapper->getIssueKey(30);
        $issue2 = $this->mapper->getIssueById(40);

        $this->assertEquals(30, $issue1['id']);
        $this->assertEquals('Testissue-255', $issue1['key']);
        $this->assertEquals('een heel cool test issue', $issue1['summary']);
        $this->assertEquals('Waiting for validation', $issue1['status']);
        $this->assertEquals('Joske', $issue1['assignee']);

        $this->assertEquals(40, $issue2['id']);
        $this->assertEquals('Testissue-256', $issue2['key']);
        $this->assertEquals('een iets minder cool test issue', $issue2['summary']);
        $this->assertEquals('To Do', $issue2['status']);
        $this->assertEquals('Jefke', $issue2['assignee']);

    }

}
