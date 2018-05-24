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
                                       'name' => 'Waiting for validation',
                               ],

                                   'summary' => 'een heel cool test issue'
                               ,

                                   'assignee' => [
                                       'name' => 'Joske'
                                   ],
                               'customfield_11001' => '',
                               'issuetype' => [
                                   'name' => 'bug'
                               ]

                           ]
                       ],

                        [
                            'key' => 'Testissue-256',
                            'id' => 30,
                            'fields' => [
                                'status' => [
                                    'name' => 'To Do',
                                ],

                                'summary' => 'een iets minder cool test issue'
                                ,

                                'assignee' => [
                                    'name' => 'Jefke'
                                ],
                                'customfield_11001' => '',
                                'issuetype' => [
                                    'name' => 'bug'
                                ]

                            ]
                        ]


                ]
        ]];

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
}
