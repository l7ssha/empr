<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221010202451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add Position entity';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE user_positions (id VARCHAR(64) NOT NULL, name VARCHAR(32) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D67F68985E237E06 ON user_positions (name)');
        $this->addSql('CREATE TABLE position_role (position_id VARCHAR(64) NOT NULL, role_id VARCHAR(64) NOT NULL, PRIMARY KEY(position_id, role_id))');
        $this->addSql('CREATE INDEX IDX_44F1A434DD842E46 ON position_role (position_id)');
        $this->addSql('CREATE INDEX IDX_44F1A434D60322AC ON position_role (role_id)');
        $this->addSql('ALTER TABLE position_role ADD CONSTRAINT FK_44F1A434DD842E46 FOREIGN KEY (position_id) REFERENCES user_positions (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE position_role ADD CONSTRAINT FK_44F1A434D60322AC FOREIGN KEY (role_id) REFERENCES user_roles (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users ADD position_id VARCHAR(64) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9DD842E46 FOREIGN KEY (position_id) REFERENCES user_positions (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1483A5E9DD842E46 ON users (position_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE users DROP CONSTRAINT FK_1483A5E9DD842E46');
        $this->addSql('ALTER TABLE position_role DROP CONSTRAINT FK_44F1A434DD842E46');
        $this->addSql('ALTER TABLE position_role DROP CONSTRAINT FK_44F1A434D60322AC');
        $this->addSql('DROP TABLE user_positions');
        $this->addSql('DROP TABLE position_role');
        $this->addSql('DROP INDEX IDX_1483A5E9DD842E46');
        $this->addSql('ALTER TABLE users DROP position_id');
    }
}
