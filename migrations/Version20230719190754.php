<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Utils\Migrations\AbstractRoleMigration;

final class Version20230719190754 extends AbstractRoleMigration
{
    public function getRolesToAdd(): array
    {
        return ['ROLE_CREATE_FILMS'];
    }
}
