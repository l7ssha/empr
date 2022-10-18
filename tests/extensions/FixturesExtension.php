<?php

declare(strict_types=1);

namespace App\Tests\extensions;

use App\Kernel;
use Hautelook\AliceBundle\PhpUnit\BaseDatabaseTrait;
use PHPUnit\Runner\BeforeFirstTestHook;

class FixturesExtension implements BeforeFirstTestHook
{
    use BaseDatabaseTrait;

    private static Kernel $kernel;

    private readonly string $appEnv;
    private readonly bool $debug;

    public function __construct(string $appEnv = 'test', bool $debug = true, bool $append = false)
    {
        self::$kernel = new Kernel($appEnv, $debug);
        self::$kernel->boot();
        self::$append = $append;
        self::$purgeWithTruncate = !$append;
    }

    public function executeBeforeFirstTest(): void
    {
        if (filter_var(getenv('USE_FIXTURES_EXTENSION'), FILTER_VALIDATE_BOOLEAN)) {
            self::populateDatabase();
        }
    }
}
