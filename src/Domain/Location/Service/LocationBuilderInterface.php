<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Domain\Location\Service;

use Tui\Weather\ApiClient\Domain\Location\Model\Location;

interface LocationBuilderInterface
{
    /**
     * @param array<string, int|string|float> $data
     *
     * @return $this|LocationBuilderInterface
     */
    public function fromArray(array $data): self;

    public function build(): Location;

    /**
     * @return array<string, int|string|float>
     */
    public function toArray(): array;
}
