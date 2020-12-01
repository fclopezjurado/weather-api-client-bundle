<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Domain\Forecast\Service;

use Tui\Weather\ApiClient\Domain\Forecast\Model\Forecast;
use Tui\Weather\ApiClient\Domain\ForecastDay\Model\ForecastDay;

class ForecastBuilder implements ForecastBuilderInterface
{
    /**
     * @var ForecastDay[]
     */
    protected $forecastday;

    /**
     * @param array<string, array<ForecastDay>> $data
     *
     * @return $this|ForecastBuilderInterface
     */
    public function fromArray(array $data): ForecastBuilderInterface
    {
        foreach ($data as $key => $value) {
            if (property_exists(self::class, $key)) {
                $this->{$key} = $value;
            }
        }

        return $this;
    }

    public function build(): Forecast
    {
        return new Forecast($this->forecastday);
    }

    /**
     * @return array<string, array<ForecastDay>>
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
