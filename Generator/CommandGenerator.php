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
    public function generateCommand($defintion)
    {
        $commandLine = array('curl');

        foreach($defintion['client'] as $optionName => $optionValue) {
            $commandLine[] = $this->generateClientArgument($optionName, $optionValue);
        }

        foreach($defintion['request'] as $optionName => $optionValue) {
            $commandLine[] = $this->generateRequestArgument($optionName, $optionValue);
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
    protected function generateClientArgument($optionName, $optionValue)
    {
        switch($optionName)
        {
            case 'proxy':
                return '--proxy '.$optionValue;
                break;
            case 'proxy_user':
                return '--proxy-user '.$optionValue;
            case 'cert':
                return '--cert '.$optionValue;
                break;
            case 'verify_peer':
                return '--insecure';
                break;
        }

        return '';
    }

    /**
     * Gènère l'argument équivalent à une option du curl en php
     *
     * @param $optionName
     * @param $optionValue
     * @return string
     */
    protected function generateRequestArgument($optionName, $optionValue)
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