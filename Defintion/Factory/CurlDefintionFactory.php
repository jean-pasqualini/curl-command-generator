<?php
/**
 * Created by PhpStorm.
 * User: prestataire
 * Date: 15/06/16
 * Time: 13:33
 */

namespace Darkilliant\CurlCommandGenerator\Defintion\Factory;


/**
 * CurlDefintionFactory
 *
 * @author Jean Pasqualini <jean.pasqualini@digitaslbi.fr>
 * @copyright 2016 DigitasLbi France
 * @package Darkilliant\CurlCommandGenerator\Defintion\Factory;
 */
class CurlDefintionFactory implements DefintionFactoryInterface
{
    /**
     * @param $ch
     * @return array
     */
    public function factory($ch)
    {
        $defintion = array(
            'client' => array(

            ),
            'request' => array(
            )
        );

        $info = curl_getinfo($ch);

        $defintion['request']['url'] = $info['url'];

        return $defintion;
    }
}