<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230726230348 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Rename development_kit table to film_developments';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE film_developments DROP CONSTRAINT fk_50b275403a8e60ef');
        $this->addSql('CREATE TABLE development_kits (id VARCHAR(36) NOT NULL, name VARCHAR(128) NOT NULL, type VARCHAR(255) NOT NULL, untracked_developments INT DEFAULT 0 NOT NULL, development_times__first_developer_time DOUBLE PRECISION NOT NULL, development_times__first_developer_multiplier DOUBLE PRECISION NOT NULL, development_times__reversal_time DOUBLE PRECISION NOT NULL, development_times__reversal_multiplier DOUBLE PRECISION NOT NULL, development_times__color_developer_time DOUBLE PRECISION NOT NULL, development_times__color_developer_multiplier DOUBLE PRECISION NOT NULL, development_times__pre_bleach_time DOUBLE PRECISION NOT NULL, development_times__pre_bleach_multiplier DOUBLE PRECISION NOT NULL, development_times__bleach_time DOUBLE PRECISION NOT NULL, development_times__bleach_multiplier DOUBLE PRECISION NOT NULL, development_times__fixer_time DOUBLE PRECISION NOT NULL, development_times__fixer_multiplier DOUBLE PRECISION NOT NULL, development_times__clearing_time DOUBLE PRECISION NOT NULL, development_times__clearing_multiplier DOUBLE PRECISION NOT NULL, development_times__second_developer_time DOUBLE PRECISION NOT NULL, development_times__second_developer_multiplier DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_841ED2EC5E237E06 ON development_kits (name)');
        $this->addSql('DROP TABLE development_kit');
        $this->addSql('ALTER TABLE film_developments DROP CONSTRAINT FK_50B275403A8E60EF');
        $this->addSql('ALTER TABLE film_developments ADD CONSTRAINT FK_50B275403A8E60EF FOREIGN KEY (kit_id) REFERENCES development_kits (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE film_developments DROP CONSTRAINT FK_50B275403A8E60EF');
        $this->addSql('CREATE TABLE development_kit (id VARCHAR(36) NOT NULL, name VARCHAR(128) NOT NULL, type VARCHAR(255) NOT NULL, untracked_developments INT DEFAULT 0 NOT NULL, development_times__first_developer_time DOUBLE PRECISION NOT NULL, development_times__first_developer_multiplier DOUBLE PRECISION NOT NULL, development_times__reversal DOUBLE PRECISION NOT NULL, development_times__reversal_multiplier DOUBLE PRECISION NOT NULL, development_times__color_developer_time DOUBLE PRECISION NOT NULL, development_times__color_developer_multiplier DOUBLE PRECISION NOT NULL, development_times__pre_bleach_time DOUBLE PRECISION NOT NULL, development_times__pre_bleach_multiplier DOUBLE PRECISION NOT NULL, development_times__bleach_time DOUBLE PRECISION NOT NULL, development_times__bleach_multiplier DOUBLE PRECISION NOT NULL, development_times__fixer_time DOUBLE PRECISION NOT NULL, development_times__fixer_multiplier DOUBLE PRECISION NOT NULL, development_times__clearing_time DOUBLE PRECISION NOT NULL, development_times__clearing_multiplier DOUBLE PRECISION NOT NULL, development_times__second_developer_time DOUBLE PRECISION NOT NULL, development_times__second_developer_multiplier DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_aff942465e237e06 ON development_kit (name)');
        $this->addSql('DROP TABLE development_kits');
        $this->addSql('ALTER TABLE film_developments DROP CONSTRAINT fk_50b275403a8e60ef');
        $this->addSql('ALTER TABLE film_developments ADD CONSTRAINT fk_50b275403a8e60ef FOREIGN KEY (kit_id) REFERENCES development_kit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
