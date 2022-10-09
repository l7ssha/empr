<?php

namespace App\Security;

interface PredefinedRoles
{
    public const ROLE_DISPLAY_PRODUCTS = 'DISPLAY_PRODUCTS';
    public const ROLE_DISPLAY_USERS = 'DISPLAY_USERS';

    public const ROLE_DESCRIPTIONS = [
        self::ROLE_DISPLAY_PRODUCTS => 'Allows to display products',
        self::ROLE_DISPLAY_USERS => 'Allows to display users',
    ];

    public const ROLE_IDS = [
        self::ROLE_DISPLAY_PRODUCTS => '01GEJJWZ10Q6MB42MQM7C19Z7E',
        self::ROLE_DISPLAY_USERS => '01GEMFY4G6QGS8K5ESGSSPX8T5',
    ];
}
