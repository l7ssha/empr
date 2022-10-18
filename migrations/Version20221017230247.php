<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221017230247 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add index on User username';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE INDEX IDX_1483A5E9F85E0677 ON users (username)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX IDX_1483A5E9F85E0677');
    }
}
