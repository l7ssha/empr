<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230728203144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add customers table; add development_kits table; add film_developments table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE customers (id VARCHAR(36) NOT NULL, name VARCHAR(64) NOT NULL, phone VARCHAR(64) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_62534E215E237E06 ON customers (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_62534E21444F97DD ON customers (phone)');
        $this->addSql('CREATE TABLE development_kits (id VARCHAR(36) NOT NULL, name VARCHAR(128) NOT NULL, type VARCHAR(255) NOT NULL, untracked_developments INT DEFAULT 0 NOT NULL, development_times__first_developer_time DOUBLE PRECISION DEFAULT NULL, development_times__first_developer_multiplier DOUBLE PRECISION DEFAULT NULL, development_times__reversal_time DOUBLE PRECISION DEFAULT NULL, development_times__reversal_multiplier DOUBLE PRECISION DEFAULT NULL, development_times__color_developer_time DOUBLE PRECISION DEFAULT NULL, development_times__color_developer_multiplier DOUBLE PRECISION DEFAULT NULL, development_times__pre_bleach_time DOUBLE PRECISION DEFAULT NULL, development_times__pre_bleach_multiplier DOUBLE PRECISION DEFAULT NULL, development_times__bleach_time DOUBLE PRECISION DEFAULT NULL, development_times__bleach_multiplier DOUBLE PRECISION DEFAULT NULL, development_times__fixer_time DOUBLE PRECISION DEFAULT NULL, development_times__fixer_multiplier DOUBLE PRECISION DEFAULT NULL, development_times__clearing_time DOUBLE PRECISION DEFAULT NULL, development_times__clearing_multiplier DOUBLE PRECISION DEFAULT NULL, development_times__second_developer_time DOUBLE PRECISION DEFAULT NULL, development_times__second_developer_multiplier DOUBLE PRECISION DEFAULT NULL, development_times__blix_time DOUBLE PRECISION DEFAULT NULL, development_times__blix_multiplier DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_841ED2EC5E237E06 ON development_kits (name)');
        $this->addSql('CREATE TABLE film_developments (id VARCHAR(36) NOT NULL, kit_id VARCHAR(36) NOT NULL, film_id VARCHAR(36) NOT NULL, created_by_id VARCHAR(36) NOT NULL, customer_id VARCHAR(36) DEFAULT NULL, development_number VARCHAR(255) NOT NULL, notes TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_50B27540B8662C69 ON film_developments (development_number)');
        $this->addSql('CREATE INDEX IDX_50B275403A8E60EF ON film_developments (kit_id)');
        $this->addSql('CREATE INDEX IDX_50B27540567F5183 ON film_developments (film_id)');
        $this->addSql('CREATE INDEX IDX_50B27540B03A8386 ON film_developments (created_by_id)');
        $this->addSql('CREATE INDEX IDX_50B275409395C3F3 ON film_developments (customer_id)');
        $this->addSql('ALTER TABLE film_developments ADD CONSTRAINT FK_50B275403A8E60EF FOREIGN KEY (kit_id) REFERENCES development_kits (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE film_developments ADD CONSTRAINT FK_50B27540567F5183 FOREIGN KEY (film_id) REFERENCES films (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE film_developments ADD CONSTRAINT FK_50B27540B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE film_developments ADD CONSTRAINT FK_50B275409395C3F3 FOREIGN KEY (customer_id) REFERENCES customers (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE film_developments DROP CONSTRAINT FK_50B275403A8E60EF');
        $this->addSql('ALTER TABLE film_developments DROP CONSTRAINT FK_50B27540567F5183');
        $this->addSql('ALTER TABLE film_developments DROP CONSTRAINT FK_50B27540B03A8386');
        $this->addSql('ALTER TABLE film_developments DROP CONSTRAINT FK_50B275409395C3F3');
        $this->addSql('DROP TABLE customers');
        $this->addSql('DROP TABLE development_kits');
        $this->addSql('DROP TABLE film_developments');
    }
}
