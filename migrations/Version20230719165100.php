<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Enum\FilmType;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Component\Uid\UuidV6;

final class Version20230719165100 extends AbstractMigration
{
    private const PREDEFINED_FILMS = [
        [
            'name' => 'Fomapan 100',
            'type' => FilmType::BW,
            'speed' => 100,
        ],
        [
            'name' => 'Fomapan 200',
            'type' => FilmType::BW,
            'speed' => 200,
        ],
        [
            'name' => 'Fomapan 400',
            'type' => FilmType::BW,
            'speed' => 400,
        ],
        [
            'name' => 'Kodak Vision3 500T',
            'type' => FilmType::COLOR_NEGATIVE,
            'speed' => 500,
        ],
    ];

    public function getDescription(): string
    {
        return 'Add Film entity';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE films (id VARCHAR(36) NOT NULL, name VARCHAR(64) NOT NULL, type VARCHAR(255) NOT NULL, speed INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CEECCA515E237E06 ON films (name)');

        /** @var array{name: string, type: FilmType, speed: int} $film */
        foreach (self::PREDEFINED_FILMS as $film) {
            $this->addSql(
                sprintf(
                    "INSERT INTO films(id, name, type, speed) VALUES ('%s', '%s', '%s', '%s')",
                    UuidV6::generate(),
                    $film['name'],
                    $film['type']->value,
                    $film['speed'],
                ),
            );
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE films');
    }
}
