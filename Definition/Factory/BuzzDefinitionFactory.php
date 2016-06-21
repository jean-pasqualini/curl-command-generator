<?php

namespace Darkilliant\CurlCommandGenerator\Definition\Factory;

use Buzz\Client\ClientInterface;
use Buzz\Client\Curl;
use Buzz\Message\Request;


/**
 * BuzzDefinitionFactory
 *
 * @author Jean Pasqualini <jpasqualini75@gmail.com>
 * @package Darkilliant\CurlCommandGenerator\Definition\Factory;
 */
class BuzzDefinitionFactory implements DefinitionFactoryInterface
{
    protected function extractCurlOptions(Curl $curl)
    {
        $reflectionClass = new \ReflectionClass($curl);

        $reflOptions = $reflectionClass->getProperty('options');

        $reflOptions->setAccessible(true);

        $options = $reflOptions->getValue($curl);

        $reflOptions->setAccessible(false);

        return $options;
    }

    public function factory(Curl $client, Request $request)
    {
        $options = $this->extractCurlOptions($client);

        $definition = array(
            'client' => array(

            ),
            'request' => array(

            )
        );

        // Client

        // Proxy

        if($client->getProxy())
        {
            $definition['client']['proxy'] = $client->getProxy();
        }

        if (!$client->getVerifyPeer())
        {
            $definition['client']['verify_peer'] = false;
        }

        // Certicate client

        if (!empty($options[CURLOPT_SSLCERT])) {
            $definition['client']['cert'] = $options[CURLOPT_SSLCERT];
        }


        // Request

        // Url

        $definition['request']['url'] = $request->getUrl();

        // Headers

        if (!empty($request->getHeaders())) {

            $headers = $request->getHeaders();
            foreach($headers as $headerLine)
            {
                list($headerName, $headerValue) = explode(': ', $headerLine);

                $definition['request']['headers'][$headerName] = $headerValue;
            }
        }

        return $definition;
    }
}