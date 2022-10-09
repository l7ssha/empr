<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\User\User;
use App\Security\PredefinedRoles;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221005164301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create ROLE_DISPLAY_PRODUCTS role and add it to admin';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            sprintf(
                "INSERT INTO user_roles(id, name, description) VALUES ('%s', '%s', '%s')",
                PredefinedRoles::ROLE_IDS[PredefinedRoles::ROLE_DISPLAY_USERS],
                PredefinedRoles::ROLE_DISPLAY_USERS,
                PredefinedRoles::ROLE_DESCRIPTIONS[PredefinedRoles::ROLE_DISPLAY_USERS],
            )
        );

        $this->addSql(
            sprintf(
                "INSERT INTO user_role(user_id, role_id) VALUES ((SELECT id FROM users WHERE username = '%s'), '%s')",
                User::ADMIN_USERNAME,
                PredefinedRoles::ROLE_IDS[PredefinedRoles::ROLE_DISPLAY_USERS],
            )
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql(
            sprintf(
                "REMOVE FROM user_role WHERE user_id = (SELECT id FROM users WHERE email = '%s') AND role_id = %s",
                User::ADMIN_USERNAME,
                PredefinedRoles::ROLE_IDS[PredefinedRoles::ROLE_DISPLAY_USERS],
            )
        );

        $this->addSql(
            sprintf(
                "REMOVE FROM user_roles WHERE id = '%s'",
                PredefinedRoles::ROLE_IDS[PredefinedRoles::ROLE_DISPLAY_USERS]
            )
        );
    }
}
