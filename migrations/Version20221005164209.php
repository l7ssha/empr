<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221005164209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Make username in user non nullable';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE users ALTER username SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE users ALTER username DROP NOT NULL');
    }
}
