<?php

namespace App\Tests\functional\api\User;

use App\Tests\AuthenticatedWebTestCase;

class GetUserTest extends AuthenticatedWebTestCase
{
    public function testUnAuthorized(): void
    {
        $client = self::createClient();

        $client->request('GET', '/api/users');

        self::assertEquals(401, $client->getResponse()->getStatusCode());
    }
}
