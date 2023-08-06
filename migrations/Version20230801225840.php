<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230801225840 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add developers entities';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE developers (id VARCHAR(36) NOT NULL, name VARCHAR(255) NOT NULL, original_volume DOUBLE PRECISION NOT NULL, used_volume DOUBLE PRECISION DEFAULT \'0\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BB14EDA5E237E06 ON developers (name)');
        $this->addSql('CREATE TABLE one_shot_developments (id VARCHAR(36) NOT NULL, developer_id VARCHAR(36) NOT NULL, development_id VARCHAR(36) NOT NULL, dilution VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_62C0CFA864DD9267 ON one_shot_developments (developer_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_62C0CFA8B0B464C4 ON one_shot_developments (development_id)');
        $this->addSql('ALTER TABLE one_shot_developments ADD CONSTRAINT FK_62C0CFA864DD9267 FOREIGN KEY (developer_id) REFERENCES developers (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE one_shot_developments ADD CONSTRAINT FK_62C0CFA8B0B464C4 FOREIGN KEY (development_id) REFERENCES film_developments (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE film_developments ADD one_shot_development_id VARCHAR(36) DEFAULT NULL');
        $this->addSql('ALTER TABLE film_developments ALTER kit_id DROP NOT NULL');
        $this->addSql('ALTER TABLE film_developments ADD CONSTRAINT FK_50B27540E36B53D4 FOREIGN KEY (one_shot_development_id) REFERENCES one_shot_developments (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_50B27540E36B53D4 ON film_developments (one_shot_development_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE film_developments DROP CONSTRAINT FK_50B27540E36B53D4');
        $this->addSql('ALTER TABLE one_shot_developments DROP CONSTRAINT FK_62C0CFA864DD9267');
        $this->addSql('ALTER TABLE one_shot_developments DROP CONSTRAINT FK_62C0CFA8B0B464C4');
        $this->addSql('DROP TABLE developers');
        $this->addSql('DROP TABLE one_shot_developments');
        $this->addSql('DROP INDEX UNIQ_50B27540E36B53D4');
        $this->addSql('ALTER TABLE film_developments DROP one_shot_development_id');
        $this->addSql('ALTER TABLE film_developments ALTER kit_id SET NOT NULL');
    }
}
