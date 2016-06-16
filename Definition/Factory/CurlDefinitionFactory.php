<?php
/**
 * Created by PhpStorm.
 * User: prestataire
 * Date: 15/06/16
 * Time: 13:33
 */

namespace Darkilliant\CurlCommandGenerator\Definition\Factory;


/**
 * CurlDefinitionFactory
 *
 * @author Jean Pasqualini <jean.pasqualini@digitaslbi.fr>
 * @copyright 2016 DigitasLbi France
 * @package Darkilliant\CurlCommandGenerator\Definition\Factory;
 */
class CurlDefinitionFactory implements DefinitionFactoryInterface
{
    /**
     * @param $ch
     * @return array
     */
    public function factory($ch)
    {
        $Definition = array(
            'client' => array(

            ),
            'request' => array(
            )
        );

        $info = curl_getinfo($ch);

        $Definition['request']['url'] = $info['url'];

        return $Definition;
    }
}