<?php
/**
 * Created by PhpStorm.
 * User: prestataire
 * Date: 14/06/16
 * Time: 13:28
 */

namespace Darkilliant\CurlCommandGenerator\Tests\Generator;

use Darkilliant\CurlCommandGenerator\Generator\CommandGenerator;


/**
 * CommandGenerator
 *
 * @author Jean Pasqualini <jean.pasqualini@digitaslbi.fr>
 * @copyright 2016 DigitasLbi France
 * @package Darkilliant\CurlCommandGenerator\Generator
 * @runTestsInSeparateProcesses
 */
class CommandGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * $commandGenerator = new CommandGenerator();
     *
     * $ch = curl_init('http://www.example.com/');
     *
     * $commandGenerator->generateCommand($ch);
     */

    /**
     * @return array
     */
    public static function commandCurlProvider()
    {
        // Example 1
        $description = 'Appel simple http';
        $definition = array(
            'client' => array(

            ),
            'request' => array(
                'url' => 'http://www.google.com/'
            )
        );
        $commandLine = 'curl http://www.google.com/';
        yield array(
            'description' => $description,
            'definition' => $definition,
            'commandLine' => $commandLine
        );

        // Example 2
        $description = 'Appel simple https';
        $definition = array(
            'client' => array(

            ),
            'request' => array(
                'url' => 'https://www.google.com/'
            )
        );
        $commandLine = 'curl https://www.google.com/';
        yield array(
            'description' => $description,
            'definition' => $definition,
            'commandLine' => $commandLine
        );

        // Example 3
        $description = 'Appel https avec proxy';
        $definition = array(
            'client' => array(
                'proxy' => 'tcp://127.0.0.1:8080',
                'proxy_user' => 'username:password'
            ),
            'request' => array(
                'url' => 'https://www.google.com/'
            )
        );
        $commandLine = 'curl --proxy tcp://127.0.0.1:8080 --proxy-user username:password https://www.google.com/';
        yield array(
            'description' => $description,
            'definition' => $definition,
            'commandLine' => $commandLine
        );

        // Example 4
        $description = 'Appel https avec certificat client';
        $definition = array(
            'client' => array(
                'cert' => '/home/dummyuser/client-cert-stacked.pem',
            ),
            'request' => array(
                'url' => 'https://www.google.com/'
            )
        );
        $commandLine = 'curl --cert /home/dummyuser/client-cert-stacked.pem https://www.google.com/';
        yield array(
            'description' => $description,
            'definition' => $definition,
            'commandLine' => $commandLine
        );

        // Example 5
        $description = 'Appel https en mode insecure (verify_peer disabled)';
        $definition = array(
            'client' => array(
                'verify_peer' => false,
            ),
            'request' => array(
                'url' => 'https://www.google.com/'
            )
        );
        $commandLine = 'curl --insecure https://www.google.com/';
        yield array(
            'description' => $description,
            'definition' => $definition,
            'commandLine' => $commandLine
        );
    }

    public function testConstructor()
    {
        $commandGenerator = new CommandGenerator();

        $this->assertInstanceOf('Darkilliant\CurlCommandGenerator\Generator\CommandGeneratorInterface', $commandGenerator);
    }

    public function testGenerateCommand()
    {

        $tests = $this->commandCurlProvider();

        $commandGenerator = new CommandGenerator();

        foreach($tests as $testDefinition) {
            $this->assertEquals(
                $testDefinition['commandLine'],
                $commandGenerator->generateCommand($testDefinition['definition']),
                $testDefinition['description']
            );
        }
    }
}