<?php
/**
 * Created by PhpStorm.
 * User: prestataire
 * Date: 15/06/16
 * Time: 13:31
 */

namespace Darkilliant\CurlCommandGenerator\Tests\Definition\Factory;

use Darkilliant\CurlCommandGenerator\Definition\Factory\CurlDefinitionFactory;


/**
 * CurlDefinitionFactoryTest
 *
 * @author Jean Pasqualini <jean.pasqualini@digitaslbi.fr>
 * @copyright 2016 DigitasLbi France
 * @package Darkilliant\CurlCommandGenerator\Tests\Definition\Factory;
 */
class CurlDefinitionFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * $curlDefinitionFactory = new CurlDefinitionFactory();
     *
     * $ch = curl_init('http://www.google.fr');
     *
     * $curlDefinitionFactory->factory($ch);
     */

    public function testConstructor()
    {
        $curlDefinitionFactory = new CurlDefinitionFactory();

        $this->assertInstanceOf('Darkilliant\CurlCommandGenerator\Definition\Factory\DefinitionFactoryInterface', $curlDefinitionFactory);
    }

    public function testFactory()
    {
        $curlDefinitionFactory = new CurlDefinitionFactory();

        $ch = curl_init('http://www.google.fr');

        $definition = $curlDefinitionFactory->factory($ch);

        $this->assertEquals(array(
            'client' => array(

            ),
            'request' => array(
                'url' => 'http://www.google.fr'
            )
        ), $definition);
    }
}