<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221003202945 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add user entity';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE users (id VARCHAR(64) NOT NULL, email VARCHAR(64) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE users');
    }
}
