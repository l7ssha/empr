<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\User\User;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230719003312 extends AbstractMigration
{
    private const ADMIN_PASSWORD = '$2y$13$.iZjnCjHREqEct9TjmM1CuAfNZxNOzjJBTff8twL.DH/21.lZ6sES';

    public function getDescription(): string
    {
        return 'Add default admin user';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(sprintf(
            "INSERT INTO users (id, email, username, password) VALUES ('%s', '%s', '%s', '%s')",
            User::ADMIN_ID,
            User::ADMIN_EMAIL,
            User::ADMIN_USERNAME,
            self::ADMIN_PASSWORD,
        ));
    }

    public function down(Schema $schema): void
    {
        $this->addSql(sprintf("DELETE FROM users WHERE id = '%s'", User::ADMIN_ID));
    }
}
