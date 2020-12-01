<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Domain\Forecast\Model;

use Tui\Weather\ApiClient\Domain\ForecastDay\Model\ForecastDay;
use Tui\Weather\ApiClient\Domain\Shared\Model\AbstractEntity;

class Forecast extends AbstractEntity
{
    /**
     * @var ForecastDay[]
     */
    protected $forecastday;

    /**
     * @param ForecastDay[] $forecastday
     */
    public function __construct(array $forecastday)
    {
        $this->forecastday = $forecastday;
    }

    /**
     * @return ForecastDay[]
     */
    public function forecastday(): array
    {
        return $this->forecastday;
    }
}
