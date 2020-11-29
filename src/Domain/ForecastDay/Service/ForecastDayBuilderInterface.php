<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Domain\ForecastDay\Service;

use Tui\Weather\ApiClient\Domain\Day\Model\Day;
use Tui\Weather\ApiClient\Domain\ForecastDay\Model\ForecastDay;

interface ForecastDayBuilderInterface
{
    /**
     * @param array<string, int|string|Day> $data
     *
     * @return $this|ForecastDayBuilderInterface
     */
    public function fromArray(array $data): self;

    public function build(): ForecastDay;

    /**
     * @return array<string, int|string|Day>
     */
    public function toArray(): array;
}
