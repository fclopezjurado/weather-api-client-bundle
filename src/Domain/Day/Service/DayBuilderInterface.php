<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Domain\Day\Service;

use Tui\Weather\ApiClient\Domain\Condition\Model\Condition;
use Tui\Weather\ApiClient\Domain\Day\Model\Day;

interface DayBuilderInterface
{
    /**
     * @param array<string, int|string|float|Condition> $data
     *
     * @return $this|DayBuilderInterface
     */
    public function fromArray(array $data): self;

    public function build(): Day;

    /**
     * @return array<string, int|string|float|Condition>
     */
    public function toArray(): array;
}
