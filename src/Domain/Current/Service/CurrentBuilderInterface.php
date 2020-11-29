<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Domain\Current\Service;

use Tui\Weather\ApiClient\Domain\Condition\Model\Condition;
use Tui\Weather\ApiClient\Domain\Current\Model\Current;

interface CurrentBuilderInterface
{
    /**
     * @param array<string, int|string|float|Condition> $data
     *
     * @return $this|CurrentBuilderInterface
     */
    public function fromArray(array $data): self;

    public function build(): Current;

    /**
     * @return array<string, int|string|float|Condition>
     */
    public function toArray(): array;
}
