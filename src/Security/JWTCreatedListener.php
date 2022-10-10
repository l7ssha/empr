<?php

namespace App\Security;

use App\Entity\User\User;
use DateInterval;
use DateTime;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{
    public function onJWTCreated(JWTCreatedEvent $event): void
    {
        $expiration = new DateTime('now');

        /** @var User $user */
        $user = $event->getUser();

        if ($user->isSystemUser()) {
            $expiration->add(new DateInterval('PT1Y'));
        } else {
            $expiration->add(new DateInterval('PT10M'));
        }

        $payload = $event->getData();
        $payload['exp'] = $expiration->getTimestamp();
        $event->setData($payload);
    }
}
