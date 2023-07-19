<?php

declare(strict_types=1);

namespace App\Tests\functional\api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Symfony\Bundle\Test\Response as ApiPlatformResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUser;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class AuthenticatedWebTestCase extends ApiTestCase
{
    protected const GET_JSON_HEADERS = ['accept' => 'application/json'];
    protected const POST_JSON_HEADERS = ['content-type' => 'application/json', 'accept' => 'application/json'];

    /**
     * @param string[] $roles
     *
     * @throws \Exception
     */
    protected function createClientWithRoles(array $roles): HttpClientInterface
    {
        return $this->createTokenClient(self::createTokenWithRoles($roles));
    }

    private function createTokenClient(string $token): HttpClientInterface
    {
        $client = static::createClient(
            [],
            [
                'auth_bearer' => $token,
                'base_uri' => 'https://localhost',
                'headers' => self::GET_JSON_HEADERS,
            ]
        );
        $client->disableReboot();

        return $client;
    }

    /**
     * @param string[] $roles
     *
     * @throws \Exception
     */
    private static function createTokenWithRoles(array $roles): string
    {
        /** @var JWTTokenManagerInterface $jwtManager */
        $jwtManager = self::getContainer()->get('lexik_jwt_authentication.jwt_manager');
        $user = new JWTUser('admin_id', $roles);

        return $jwtManager->createFromPayload(
            $user,
            [
                'id' => $user->getUserIdentifier(),
                'roles' => $user->getRoles(),
                'username' => 'admin',
            ]
        );
    }

    /**
     * @throws TransportExceptionInterface
     */
    public static function assertHttpResponseStatusCodeSame(int $expectedCode, ResponseInterface $response): void
    {
        self::assertEquals($expectedCode, $response->getStatusCode());
    }

    /**
     * @param ApiPlatformResponse|SymfonyResponse $response
     */
    public static function assertHttpResponseIsSuccessful(mixed $response): void
    {
        self::assertTrue($response->isSuccessful());
    }
}
