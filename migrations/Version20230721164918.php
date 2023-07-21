<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230721164918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add DevelopmentKit and FilmDevelopment entities';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE development_kit (id VARCHAR(36) NOT NULL, name VARCHAR(128) NOT NULL, type VARCHAR(255) NOT NULL, untracked_developments INT DEFAULT 0 NOT NULL, development_times__first_developer_time DOUBLE PRECISION NOT NULL, development_times__first_developer_multiplier DOUBLE PRECISION NOT NULL, development_times__reversal DOUBLE PRECISION NOT NULL, development_times__reversal_multiplier DOUBLE PRECISION NOT NULL, development_times__color_developer_time DOUBLE PRECISION NOT NULL, development_times__color_developer_multiplier DOUBLE PRECISION NOT NULL, development_times__pre_bleach_time DOUBLE PRECISION NOT NULL, development_times__pre_bleach_multiplier DOUBLE PRECISION NOT NULL, development_times__bleach_time DOUBLE PRECISION NOT NULL, development_times__bleach_multiplier DOUBLE PRECISION NOT NULL, development_times__fixer_time DOUBLE PRECISION NOT NULL, development_times__fixer_multiplier DOUBLE PRECISION NOT NULL, development_times__clearing_time DOUBLE PRECISION NOT NULL, development_times__clearing_multiplier DOUBLE PRECISION NOT NULL, development_times__second_developer_time DOUBLE PRECISION NOT NULL, development_times__second_developer_multiplier DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AFF942465E237E06 ON development_kit (name)');
        $this->addSql('CREATE TABLE film_developments (id VARCHAR(36) NOT NULL, kit_id VARCHAR(36) DEFAULT NULL, film_id VARCHAR(36) DEFAULT NULL, development_number VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_50B27540B8662C69 ON film_developments (development_number)');
        $this->addSql('CREATE INDEX IDX_50B275403A8E60EF ON film_developments (kit_id)');
        $this->addSql('CREATE INDEX IDX_50B27540567F5183 ON film_developments (film_id)');
        $this->addSql('ALTER TABLE film_developments ADD CONSTRAINT FK_50B275403A8E60EF FOREIGN KEY (kit_id) REFERENCES development_kit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE film_developments ADD CONSTRAINT FK_50B27540567F5183 FOREIGN KEY (film_id) REFERENCES films (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE film_developments DROP CONSTRAINT FK_50B275403A8E60EF');
        $this->addSql('ALTER TABLE film_developments DROP CONSTRAINT FK_50B27540567F5183');
        $this->addSql('DROP TABLE development_kit');
        $this->addSql('DROP TABLE film_developments');
    }
}
