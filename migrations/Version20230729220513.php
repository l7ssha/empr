<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230729220513 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add dilution do FilmDevelopment';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE film_developments ADD dilution VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE film_developments DROP dilution');
    }
}
