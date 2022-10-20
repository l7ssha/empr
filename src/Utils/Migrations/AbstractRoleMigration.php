<?php

namespace App\Utils\Migrations;

use App\Security\PredefinedRoles;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

abstract class AbstractRoleMigration extends AbstractMigration
{
    /**
     * @return string[]
     */
    abstract public function getRolesToAdd(): array;

    /**
     * @return string[]
     */
    abstract public function getUserToAddRoleTo(): array;

    /**
     * {@inheritDoc}
     */
    public function up(Schema $schema): void
    {
        foreach ($this->getRolesToAdd() as $role) {
            $this->addSql(
                sprintf(
                    "INSERT INTO user_roles(id, name, description) VALUES ('%s', '%s', '%s')",
                    PredefinedRoles::ROLE_IDS[$role],
                    $role,
                    PredefinedRoles::ROLE_DESCRIPTIONS[$role],
                )
            );
        }

        foreach (array_merge(['admin'], $this->getUserToAddRoleTo()) as $user) {
            foreach ($this->getRolesToAdd() as $role) {
                $this->addSql(
                    sprintf(
                        "INSERT INTO user_role(user_id, role_id) VALUES ((SELECT id FROM users WHERE username = '%s'), '%s')",
                        $user,
                        PredefinedRoles::ROLE_IDS[$role],
                    )
                );
            }
        }
    }

    public function down(Schema $schema): void
    {
        foreach (array_merge(['admin'], $this->getUserToAddRoleTo()) as $user) {
            foreach ($this->getRolesToAdd() as $role) {
                $this->addSql(
                    sprintf(
                        "REMOVE FROM user_role WHERE user_id = (SELECT id FROM users WHERE email = '%s') AND role_id = %s",
                        $user,
                        PredefinedRoles::ROLE_IDS[$role],
                    )
                );
            }
        }

        foreach ($this->getRolesToAdd() as $role) {
            $this->addSql(
                sprintf(
                    "REMOVE FROM user_roles WHERE id = '%s'",
                    PredefinedRoles::ROLE_IDS[$role]
                )
            );
        }
    }
}
