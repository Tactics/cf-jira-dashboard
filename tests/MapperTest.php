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
                            'id' => 40,
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

    /**
     * @test
     */
    public function mapper_can_make_multiple_issues_from_the_sprint_array()
    {
        $issues = $this->mapper->getIssues();

        /** @var \JiraAPI\Issue $issue1  */
        $this->assertEquals(30, $issues[0]->getId());
        $this->assertEquals('Testissue-255', $issues[0]->getKey());
        $this->assertEquals('een heel cool test issue', $issues[0]->getShortInfo());
        $this->assertEquals('Waiting for validation', $issues[0]->getStatename());
        $this->assertEquals('Joske', $issues[0]->getAssignee());

        $this->assertEquals(40, $issues[1]->getId());
        $this->assertEquals('Testissue-256', $issues[1]->getKey());
        $this->assertEquals('een iets minder cool test issue', $issues[1]->getShortInfo());
        $this->assertEquals('To Do', $issues[1]->getStatename());
        $this->assertEquals('Jefke', $issues[1]->getAssignee());

    }
}
