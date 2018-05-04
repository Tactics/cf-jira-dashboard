<?php
declare(strict_types=1);

namespace JiraAPI;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use GuzzleHttp\Client;

class APICallerServiceProvider
{
    /*If you have a url and your php supports it, you could just call file_get_contents:

    $response = file_get_contents('http://example.com/path/to/api/call?param1=5');
    if $response is JSON, use json_decode to turn it into php array:

    $response = json_decode($response);
    if $response is XML, use simple_xml class:

    $response = new SimpleXMLElement($response);*/

    private $username;
    private $password;

    public function __construct($username, $password)
    {

        $this->username = $username;
        $this->password = $password;
    }

    public function getClearfactsSprint()
    {
        /**
         * Resource: Jira is considered the resource
         * Resource owner: Jira user
         * Consumer: User of the application
         * http://jira.tactics.be:8080/rest/agile/latest/board/1
         */

        $client = new Client();
        $response = $client->get('http://jira.tactics.be:8080/rest/agile/latest/board/1', [
            'auth' => [
                $this->username, $this->password
                            ]
        ]);

        die(var_dump($response));
    }
}