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
        $ch = curl_init('http://www.example.com/');
        $commandLine = 'curl http://www.example.com/';
        yield array(
            'description' => $description,
            'curl' => $ch,
            'commandLine' => $commandLine
        );

        // Example 2
        $description = 'Appel simple https';
        $ch = curl_init('https://www.google.fr/');
        $commandLine = 'curl https://www.google.fr/';
        yield array(
            'description' => $description,
            'curl' => $ch,
            'commandLine' => $commandLine
        );

        // Example 3
        $description = 'Appel https avec proxy tcp';
        $ch = curl_init('https://www.google.fr/');
        curl_setopt($ch, CURLOPT_PROXY, '127.0.0.1');
        curl_setopt($ch, CURLOPT_PROXYPORT, '8080');
        $commandLine = 'curl https://www.google.fr/ --proxy tcp://127.0.0.1:8080';
        yield array(
            'description' => $description,
            'curl' => $ch,
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
                $commandGenerator->generateCommand($testDefinition['curl']),
                $testDefinition['description']
            );
        }
    }
}