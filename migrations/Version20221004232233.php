<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221004232233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add systemUser field to User entity';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE users ADD system_user BOOLEAN DEFAULT false NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE users DROP system_user');
    }
}
