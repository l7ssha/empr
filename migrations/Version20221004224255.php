<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\User\User;
use App\Security\PredefinedRoles;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221004224255 extends AbstractMigration
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
                PredefinedRoles::ROLE_IDS[PredefinedRoles::ROLE_DISPLAY_PRODUCTS],
                PredefinedRoles::ROLE_DISPLAY_PRODUCTS,
                PredefinedRoles::ROLE_DESCRIPTIONS[PredefinedRoles::ROLE_DISPLAY_PRODUCTS],
            )
        );

        $this->addSql(
            sprintf(
                "INSERT INTO user_role(user_id, role_id) VALUES ((SELECT id FROM users WHERE email = '%s'), '%s')",
                User::ADMIN_EMAIL,
                PredefinedRoles::ROLE_IDS[PredefinedRoles::ROLE_DISPLAY_PRODUCTS],
            )
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql(
            sprintf(
                "REMOVE FROM user_role WHERE user_id = (SELECT id FROM users WHERE email = '%s') AND role_id = %s",
                User::ADMIN_EMAIL,
                PredefinedRoles::ROLE_IDS[PredefinedRoles::ROLE_DISPLAY_PRODUCTS],
            )
        );

        $this->addSql(
            sprintf(
                "REMOVE FROM user_roles WHERE id = '%s'",
                PredefinedRoles::ROLE_IDS[PredefinedRoles::ROLE_DISPLAY_PRODUCTS]
            )
        );
    }
}
