<?php

declare(strict_types=1);

namespace App\Security;

interface PredefinedRoles
{
    public const ROLE_DISPLAY_USERS = 'ROLE_DISPLAY_USERS';
    public const ROLE_CREATE_FILMS = 'ROLE_CREATE_FILMS';
    public const ROLE_CREATE_DEVELOPERS = 'ROLE_CREATE_DEVELOPERS';
    public const ROLE_MODIFY_DEVELOPMENT_KIT = 'ROLE_MODIFY_DEVELOPMENT_KIT';

    public const ROLE_DESCRIPTIONS = [
        self::ROLE_DISPLAY_USERS => 'Allows to display users',
        self::ROLE_CREATE_FILMS => 'Allows to create film',
        self::ROLE_CREATE_DEVELOPERS => 'Allows to create developers',
        self::ROLE_MODIFY_DEVELOPMENT_KIT => 'Allows to modify (create/update) development kit',
    ];

    public const ROLE_IDS = [
        self::ROLE_DISPLAY_USERS => '6a99a8bc-ff69-4891-ad92-75c74ace6edd',
        self::ROLE_CREATE_FILMS => '1d89d46c-1d6f-4cfb-b9e4-15c91d408216',
        self::ROLE_CREATE_DEVELOPERS => '86705391-8c1a-4903-a33a-367cad13c777',
        self::ROLE_MODIFY_DEVELOPMENT_KIT => '88e8d720-0016-4002-8cef-ef2bcefeed56',
    ];
}
