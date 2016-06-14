<?php
/**
 * Created by PhpStorm.
 * User: prestataire
 * Date: 14/06/16
 * Time: 13:56
 */

namespace Darkilliant\CurlCommandGenerator\Generator;


/**
 * CommandGeneratorInterface
 *
 * @author Jean Pasqualini <jean.pasqualini@digitaslbi.fr>
 * @copyright 2016 DigitasLbi France
 * @package Darkilliant\CurlCommandGenerator\Generator;
 */
interface CommandGeneratorInterface
{
    public function generateCommand($ch);
}