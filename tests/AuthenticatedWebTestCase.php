<?php

namespace App\Tests;

use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthenticatedWebTestCase extends WebTestCase
{
    protected function createAuthenticatedClient(array $claims): KernelBrowser
    {
        $client = self::createClient();
        $encoder = $client->getContainer()->get(JWTEncoderInterface::class);

        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $encoder->encode($claims)));

        return $client;
    }
}
