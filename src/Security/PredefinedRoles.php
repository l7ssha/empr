<?php

namespace App\Security;

interface PredefinedRoles
{
    public const ROLE_DISPLAY_PRODUCTS = 'DISPLAY_PRODUCTS';

    public const ROLE_DESCRIPTIONS = [
        self::ROLE_DISPLAY_PRODUCTS => 'Allows to display products',
    ];

    public const ROLE_IDS = [
        self::ROLE_DISPLAY_PRODUCTS => '01GEJJWZ10Q6MB42MQM7C19Z7E',
    ];
}
