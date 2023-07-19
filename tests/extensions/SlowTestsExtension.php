<?php

declare(strict_types=1);

namespace App\Tests\extensions;

use PHPUnit\Runner\AfterLastTestHook;
use PHPUnit\Runner\AfterTestHook;

class SlowTestsExtension implements AfterTestHook, AfterLastTestHook
{
    /**
     * @var array<string, int>
     */
    private array $slow = [];

    public function __construct(private readonly int $slowThreshold = 500, private readonly int $reportLength = 10)
    {
    }

    public function executeAfterTest(string $test, float $time): void
    {
        $timeInMilliseconds = $this->toMilliseconds($time);
        $threshold = $this->slowThreshold;

        if ($this->isSlow($timeInMilliseconds, $threshold)) {
            $this->addSlowTest($test, $timeInMilliseconds);
        }
    }

    public function executeAfterLastTest(): void
    {
        if ($this->hasSlowTests()) {
            arsort($this->slow);

            $this->renderHeader();
            $this->renderBody();
            $this->renderFooter();
        }
    }

    private function isSlow(int $time, int $slowThreshold): bool
    {
        return $time >= $slowThreshold;
    }

    private function addSlowTest(string $test, int $time): void
    {
        $this->slow[$test] = $time;
    }

    private function hasSlowTests(): bool
    {
        return !empty($this->slow);
    }

    private function toMilliseconds(float $time): int
    {
        return (int) round($time * 1000);
    }

    protected function getReportLength(): int
    {
        return min(\count($this->slow), $this->reportLength);
    }

    private function getHiddenCount(): int
    {
        $total = \count($this->slow);
        $showing = $this->getReportLength();

        $hidden = 0;
        if ($total > $showing) {
            $hidden = $total - $showing;
        }

        return $hidden;
    }

    private function renderHeader(): void
    {
        echo sprintf("\n\nYou should really speed up these slow tests (>%sms)...\n", $this->slowThreshold);
    }

    private function renderBody(): void
    {
        $slowTests = $this->slow;

        $length = $this->getReportLength();
        for ($i = 1; $i <= $length; ++$i) {
            $label = key($slowTests);
            $time = array_shift($slowTests);

            echo sprintf(" %s. %sms to run %s\n", $i, $time, $label);
        }
    }

    private function renderFooter(): void
    {
        if ($hidden = $this->getHiddenCount()) {
            echo sprintf('...and there %s %s more above your threshold hidden from view', $hidden === 1 ? 'is' : 'are', $hidden);
        }
    }
}
