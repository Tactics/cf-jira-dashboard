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
    {   /** @var \JiraAPI\Sprint $sprint  */
        $sprint = $this->mapper->getSprint();

        $this->assertEquals('SPRINT 16-4', $sprint->getName());
        $this->assertEquals('the moon', $sprint->getGoal());
        $this->assertEquals('485', $sprint->getId());

    }

    /**
     * @test
     */
    public function mapper_can_make_multiple_issues_from_the_sprint_array()
    {
        $issue1 = $this->mapper->getIssueById(30);
        $issue2 = $this->mapper->getIssueById(40);

        /** @var \JiraAPI\Issue $issue1  */
        $this->assertEquals(30, $issue1->getId());
        $this->assertEquals('Testissue-255', $issue1->getKey());
        $this->assertEquals('een heel cool test issue', $issue1->getShortInfo());
        $this->assertEquals('Waiting for validation', $issue1->getStatus());
        $this->assertEquals('Joske', $issue1->getAssignee());

        $this->assertEquals(40, $issue2->getId());
        $this->assertEquals('Testissue-256', $issue2->getKey());
        $this->assertEquals('een iets minder cool test issue', $issue2->getShortInfo());
        $this->assertEquals('To Do', $issue2->getStatus());
        $this->assertEquals('Jefke', $issue2->getAssignee());

    }

}
