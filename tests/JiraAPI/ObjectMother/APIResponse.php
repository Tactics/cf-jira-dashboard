<?php
declare(strict_types=1);

namespace Tests\JiraAPI\ObjectMother;

/**
 * Class APIResponse
 * @package Tests\JiraAPI\ObjectMother
 */
class APIResponse
{
    /**
     * @return array
     */
    public static function currentSprintWith2Issues(): array
    {
        return [
            'sprintname' => 'SPRINT 16-4',
            'goal' => 'the moon',
            'sprintId' => 485,
            'issues' => [
                'issues' => [
                    [
                        'key' => 'Testissue-255',
                        'id' => '30',
                        'fields' => [
                            'status' => [
                                'name' => 'Waiting for validation',
                            ],
                            'summary' => 'een heel cool test issue'
                            ,
                            'assignee' => [
                                'name' => 'Joske'
                            ],
                            'customfield_11001' => [],
                            'issuetype' => [
                                'name' => 'bug'
                            ]
                        ]
                    ],
                    [
                        'key' => 'Testissue-256',
                        'id' => '30',
                        'fields' => [
                            'status' => [
                                'name' => 'To Do',
                            ],
                            'summary' => 'een iets minder cool test issue'
                            ,
                            'assignee' => [
                                'name' => 'Jefke'
                            ],
                            'customfield_11001' => [],
                            'issuetype' => [
                                'name' => 'bug'
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }
}