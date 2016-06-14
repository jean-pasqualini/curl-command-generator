<?php
/**
 * Created by PhpStorm.
 * User: prestataire
 * Date: 14/06/16
 * Time: 13:37
 */

namespace Darkilliant\CurlCommandGenerator\Generator;


/**
 * CommandGenerator
 *
 * @author Jean Pasqualini <jean.pasqualini@digitaslbi.fr>
 * @copyright 2016 DigitasLbi France
 * @package Darkilliant\CurlCommandGenerator\Generator;
 */
class CommandGenerator implements CommandGeneratorInterface
{
    /**
     * Gènère l'equivalent de l'appel curl php en commande linux
     *
     * @param $ch
     * @return string
     */
    public function generateCommand($ch)
    {
        $info = curl_getinfo($ch);

        $commandLine = array('curl');

        foreach($info as $optionName => $optionValue) {
            $commandLine[] = $this->generateArgument($optionName, $optionValue);
        }

        $commandLine = array_filter($commandLine, function($item) {
            return !empty($item);
        });

        return implode(' ', $commandLine);
    }

    /**
     * Gènère l'argument équivalent à une option du curl en php
     *
     * @param $optionName
     * @param $optionValue
     * @return string
     */
    protected function generateArgument($optionName, $optionValue)
    {
        switch($optionName)
        {
            case 'url':
                return $optionValue;
                break;
        }

        return '';
    }
}