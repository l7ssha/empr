<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Security\PredefinedRoles;
use App\Utils\Migrations\AbstractRoleMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230821175023 extends AbstractRoleMigration
{
    public function getRolesToAdd(): array
    {
        return [
            PredefinedRoles::ROLE_MANAGE_FILMS,
            PredefinedRoles::ROLE_MANAGE_DEVELOPERS,
            PredefinedRoles::ROLE_MANAGE_DEVELOPMENT_KIT,
        ];
    }
}
