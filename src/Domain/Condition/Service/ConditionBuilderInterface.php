<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Domain\Condition\Service;

use Tui\Weather\ApiClient\Domain\Condition\Model\Condition;

interface ConditionBuilderInterface
{
    /**
     * @param array<string, int|string> $data
     *
     * @return $this|ConditionBuilderInterface
     */
    public function fromArray(array $data): self;

    public function build(): Condition;

    /**
     * @return array<string, int|string>
     */
    public function toArray(): array;
}
