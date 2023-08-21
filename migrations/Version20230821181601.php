<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230821181601 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Make Developer, Film and DevelopmentKit nullable';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE developers ADD deleted_by_id VARCHAR(36) DEFAULT NULL');
        $this->addSql('ALTER TABLE developers ADD deleted_at TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN developers.deleted_at IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('ALTER TABLE developers ADD CONSTRAINT FK_BB14EDAC76F1F52 FOREIGN KEY (deleted_by_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BB14EDAC76F1F52 ON developers (deleted_by_id)');
        $this->addSql('ALTER TABLE development_kits ADD deleted_by_id VARCHAR(36) DEFAULT NULL');
        $this->addSql('ALTER TABLE development_kits ADD deleted_at TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN development_kits.deleted_at IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('ALTER TABLE development_kits ADD CONSTRAINT FK_841ED2ECC76F1F52 FOREIGN KEY (deleted_by_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_841ED2ECC76F1F52 ON development_kits (deleted_by_id)');
        $this->addSql('ALTER TABLE films ADD deleted_by_id VARCHAR(36) DEFAULT NULL');
        $this->addSql('ALTER TABLE films ADD deleted_at TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN films.deleted_at IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('ALTER TABLE films ADD CONSTRAINT FK_CEECCA51C76F1F52 FOREIGN KEY (deleted_by_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_CEECCA51C76F1F52 ON films (deleted_by_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE development_kits DROP CONSTRAINT FK_841ED2ECC76F1F52');
        $this->addSql('DROP INDEX IDX_841ED2ECC76F1F52');
        $this->addSql('ALTER TABLE development_kits DROP deleted_by_id');
        $this->addSql('ALTER TABLE development_kits DROP deleted_at');
        $this->addSql('ALTER TABLE films DROP CONSTRAINT FK_CEECCA51C76F1F52');
        $this->addSql('DROP INDEX IDX_CEECCA51C76F1F52');
        $this->addSql('ALTER TABLE films DROP deleted_by_id');
        $this->addSql('ALTER TABLE films DROP deleted_at');
        $this->addSql('ALTER TABLE developers DROP CONSTRAINT FK_BB14EDAC76F1F52');
        $this->addSql('DROP INDEX IDX_BB14EDAC76F1F52');
        $this->addSql('ALTER TABLE developers DROP deleted_by_id');
        $this->addSql('ALTER TABLE developers DROP deleted_at');
    }
}
