<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Domain\ForecastDay\Service;

use Tui\Weather\ApiClient\Domain\Day\Model\Day;
use Tui\Weather\ApiClient\Domain\ForecastDay\Model\ForecastDay;

interface ForecastDayBuilderInterface
{
    /**
     * @param array<string, array|float|int|string|Day|null> $data
     *
     * @return $this|ForecastDayBuilderInterface
     */
    public function fromArray(array $data): self;

    public function build(): ForecastDay;

    /**
     * @return array<string, array|float|int|string|Day|null>
     */
    public function toArray(): array;
}
