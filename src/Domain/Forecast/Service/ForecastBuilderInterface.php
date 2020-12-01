<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Domain\Forecast\Service;

use Tui\Weather\ApiClient\Domain\Forecast\Model\Forecast;
use Tui\Weather\ApiClient\Domain\ForecastDay\Model\ForecastDay;

interface ForecastBuilderInterface
{
    /**
     * @param array<string, array<ForecastDay>> $data
     *
     * @return $this|ForecastBuilderInterface
     */
    public function fromArray(array $data): self;

    public function build(): Forecast;

    /**
     * @return array<string, array<ForecastDay>>
     */
    public function toArray(): array;
}
