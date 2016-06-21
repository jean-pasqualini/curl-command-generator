<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace Darkilliant\CurlCommandGenerator\Tests\Definition\Factory;

use Buzz\Client\Curl;
use Buzz\Message\Request;
use Darkilliant\CurlCommandGenerator\Definition\Factory\BuzzDefinitionFactory;

/**
 * BuzzDefintionFactoryTest
 *
 * @author Jean Pasqualini <jpasqualini75@gmail.com>
 * @package Darkilliant\CurlCommandGenerator\Tests\Definition\Factory;
 */
class BuzzDefintionFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $buzzDefinitionFactory = new BuzzDefinitionFactory();

        $this->assertInstanceOf('Darkilliant\CurlCommandGenerator\Definition\Factory\DefinitionFactoryInterface', $buzzDefinitionFactory);
    }

    public function testFactorySimpleHttp()
    {
        $buzzDefinitionFactory = new BuzzDefinitionFactory();

        $client = new Curl();

        $request = new Request();

        $request->setResource('http://www.google.fr/');

        $definition = $buzzDefinitionFactory->factory($client, $request);

        $this->assertEquals(array(
            'client' => array(

            ),
            'request' => array(
                'url' => 'http://www.google.fr/'
            )
        ), $definition);
    }

    public function testFactorySimpleHttps()
    {
        $buzzDefinitionFactory = new BuzzDefinitionFactory();

        $client = new Curl();

        $request = new Request();

        $request->setResource('https://www.google.fr/');

        $definition = $buzzDefinitionFactory->factory($client, $request);

        $this->assertEquals(array(
            'client' => array(

            ),
            'request' => array(
                'url' => 'https://www.google.fr/'
            )
        ), $definition);
    }

    public function testFactoryHttpsWithProxy()
    {
        $buzzDefinitionFactory = new BuzzDefinitionFactory();

        $client = new Curl();

        $client->setProxy('tcp://127.0.0.1:8080');

        $request = new Request();

        $request->setResource('https://www.google.fr/');

        $definition = $buzzDefinitionFactory->factory($client, $request);

        $this->assertEquals(array(
            'client' => array(
                'proxy' => 'tcp://127.0.0.1:8080'
            ),
            'request' => array(
                'url' => 'https://www.google.fr/'
            )
        ), $definition);
    }

    public function testFactoryHttpsWithClientCertificate()
    {
        $buzzDefinitionFactory = new BuzzDefinitionFactory();

        $client = new Curl();

        $client->setOption(CURLOPT_SSLCERT, '/home/dummyuser/client-cert-stacked.pem');

        $request = new Request();

        $request->setResource('https://www.google.fr/');

        $definition = $buzzDefinitionFactory->factory($client, $request);

        $this->assertEquals(array(
            'client' => array(
                'cert' => '/home/dummyuser/client-cert-stacked.pem'
            ),
            'request' => array(
                'url' => 'https://www.google.fr/'
            )
        ), $definition);
    }

    public function testFactoryHttpsVerifyPeerDisabled()
    {
        $buzzDefinitionFactory = new BuzzDefinitionFactory();

        $client = new Curl();

        $client->setVerifyPeer(false);

        $request = new Request();

        $request->setResource('https://www.google.fr/');

        $definition = $buzzDefinitionFactory->factory($client, $request);

        $this->assertEquals(array(
            'client' => array(
                'verify_peer' => false
            ),
            'request' => array(
                'url' => 'https://www.google.fr/'
            )
        ), $definition);
    }

    public function testFactoryHttpWithHeadersCustom()
    {
        $buzzDefinitionFactory = new BuzzDefinitionFactory();

        $client = new Curl();

        $request = new Request();

        $request->setHeaders(array(
            'Entete-A' => 'value-a',
            'Entete-B' => 'value-b',
        ));

        $request->setResource('https://www.google.fr/');

        $definition = $buzzDefinitionFactory->factory($client, $request);

        $this->assertEquals(array(
            'client' => array(
            ),
            'request' => array(
                'url' => 'https://www.google.fr/',
                'headers' => array(
                    'Entete-A' => 'value-a',
                    'Entete-B' => 'value-b',
                )
            )
        ), $definition);
    }
}