<?php

declare(strict_types=1);

namespace App\Security;

interface PredefinedRoles
{
    public const ROLE_DISPLAY_USERS = 'ROLE_DISPLAY_USERS';

    public const ROLE_DESCRIPTIONS = [
        self::ROLE_DISPLAY_USERS => 'Allows to display users',
    ];

    public const ROLE_IDS = [
        self::ROLE_DISPLAY_USERS => '6a99a8bc-ff69-4891-ad92-75c74ace6edd',
    ];
}
