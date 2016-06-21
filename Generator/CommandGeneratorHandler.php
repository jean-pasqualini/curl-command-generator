<?php

namespace Darkilliant\CurlCommandGenerator\Generator;

use Darkilliant\CurlCommandGenerator\Definition\Factory\DefinitionFactoryInterface;


/**
 * CommandGeneratorHandler
 *
 * @author Jean Pasqualini <jpasqualini75@gmail.com>
 * @package Darkilliant\CurlCommandGenerator\Generator;
 */
class CommandGeneratorHandler
{
    protected $definitionFactoryCollection = array();

    public function addDefinitionFactory(DefinitionFactoryInterface $definitionFactory)
    {
        $this->definitionFactoryCollection[] = $definitionFactory;
    }
}