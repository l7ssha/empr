<?php

declare(strict_types=1);

namespace App\Security;

use App\Entity\User\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{
    public function onJWTCreated(JWTCreatedEvent $event): void
    {
        $user = $event->getUser();
        if (!$user instanceof User) {
            return;
        }

        $event->setData(
            array_merge($event->getData(), $this->getPayloadData($user))
        );
    }

    private function getPayloadData(User $user): array
    {
        $expiration = new \DateTime('now');
        if ($user->isSystemUser()) {
            $expiration->add(new \DateInterval('PT1Y'));
        } else {
            $expiration->add(new \DateInterval('PT10M'));
        }

        return [
            'exp' => $expiration->getTimestamp(),
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'systemUser' => $user->isSystemUser(),
        ];
    }
}
