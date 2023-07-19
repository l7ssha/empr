<?php

declare(strict_types=1);

namespace App\Tests\functional\api\User;

use App\Security\PredefinedRoles;
use App\Tests\functional\api\AuthenticatedWebTestCase;

class GetUserTest extends AuthenticatedWebTestCase
{
    public function testUnAuthorized(): void
    {
        $client = self::createClient();

        $response = $client->request('GET', '/api/users');
        self::assertHttpResponseStatusCodeSame(401, $response);
    }

    public function testMissingPermissions(): void
    {
        $client = self::createClientWithRoles([]);

        $response = $client->request('GET', '/api/users');
        self::assertHttpResponseStatusCodeSame(403, $response);
    }

    public function testSuccess(): void
    {
        $client = self::createClientWithRoles([PredefinedRoles::ROLE_DISPLAY_USERS]);

        $response = $client->request('GET', '/api/users');
        self::assertHttpResponseStatusCodeSame(200, $response);
    }
}
