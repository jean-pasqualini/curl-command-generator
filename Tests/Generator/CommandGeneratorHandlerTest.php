<?php

namespace Darkilliant\CurlCommandGenerator\Tests\Generator;

use Darkilliant\CurlCommandGenerator\Generator\CommandGeneratorHandler;


/**
 * CommandGeneratorHandlerTest
 *
 * @author Jean Pasqualini <jpasqualini75@gmail.com>
 * @package Darkilliant\CurlCommandGenerator\Tests\Generator;
 */
class CommandGeneratorHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $commandGeneratorHandler = new CommandGeneratorHandler();

        $this->assertInstanceOf('Darkilliant\CurlCommandGenerator\Generator\CommandGeneratorHandler', $commandGeneratorHandler);
    }

    public function testAddDefintionFactoryPassDefinitionFactoryInterface()
    {
        $commandGeneratorHandler = new CommandGeneratorHandler();

        $defintionFactoryFake = $this->getMock('Darkilliant\CurlCommandGenerator\Definition\Factory\DefinitionFactoryInterface');

        $commandGeneratorHandler->addDefinitionFactory($defintionFactoryFake);
    }
}