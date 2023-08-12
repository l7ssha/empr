<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Security\PredefinedRoles;
use App\Utils\Migrations\AbstractRoleMigration;

final class Version20230812141702 extends AbstractRoleMigration
{
    public function getRolesToAdd(): array
    {
        return [
            PredefinedRoles::ROLE_CREATE_DEVELOPERS,
            PredefinedRoles::ROLE_MODIFY_DEVELOPMENT_KIT,
        ];
    }
}
