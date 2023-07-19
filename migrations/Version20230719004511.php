<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Security\PredefinedRoles;
use App\Utils\Migrations\AbstractRoleMigration;

final class Version20230719004511 extends AbstractRoleMigration
{
    public function getRolesToAdd(): array
    {
        return [PredefinedRoles::ROLE_DISPLAY_USERS];
    }
}
