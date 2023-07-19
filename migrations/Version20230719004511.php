<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Utils\Migrations\AbstractRoleMigration;

final class Version20230719004511 extends AbstractRoleMigration
{
    public function getRolesToAdd(): array
    {
        return ['ROLE_DISPLAY_USERS'];
    }

    public function getUserToAddRoleTo(): array
    {
        return [];
    }
}
