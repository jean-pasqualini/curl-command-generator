<?php
/**
 * Created by PhpStorm.
 * User: prestataire
 * Date: 15/06/16
 * Time: 13:31
 */

namespace Darkilliant\CurlCommandGenerator\Tests\Defintion\Factory;

use Darkilliant\CurlCommandGenerator\Defintion\Factory\CurlDefintionFactory;


/**
 * CurlDefintionFactoryTest
 *
 * @author Jean Pasqualini <jean.pasqualini@digitaslbi.fr>
 * @copyright 2016 DigitasLbi France
 * @package Darkilliant\CurlCommandGenerator\Tests\Defintion\Factory;
 */
class CurlDefintionFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * $curlDefintionFactory = new CurlDefintionFactory();
     *
     * $ch = curl_init('http://www.google.fr');
     *
     * $curlDefintionFactory->factory($ch);
     */

    public function testConstructor()
    {
        $curlDefintionFactory = new CurlDefintionFactory();

        $this->assertInstanceOf('Darkilliant\CurlCommandGenerator\Defintion\Factory\DefintionFactoryInterface', $curlDefintionFactory);
    }

    public function testFactory()
    {
        $curlDefintionFactory = new CurlDefintionFactory();

        $ch = curl_init('http://www.google.fr');

        $definition = $curlDefintionFactory->factory($ch);

        $this->assertEquals(array(
            'client' => array(

            ),
            'request' => array(
                'url' => 'http://www.google.fr'
            )
        ), $definition);
    }
}