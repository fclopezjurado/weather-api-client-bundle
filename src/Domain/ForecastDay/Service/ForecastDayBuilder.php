<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Domain\ForecastDay\Service;

use Tui\Weather\ApiClient\Domain\Day\Model\Day;
use Tui\Weather\ApiClient\Domain\ForecastDay\Model\ForecastDay;

class ForecastDayBuilder implements ForecastDayBuilderInterface
{
    /**
     * @var string
     */
    protected $date;

    /**
     * @var int
     */
    protected $dateEpoch;

    /**
     * @var Day
     */
    protected $day;

    /**
     * @param array<string, int|string|Day> $data
     *
     * @return $this|ForecastDayBuilderInterface
     */
    public function fromArray(array $data): ForecastDayBuilderInterface
    {
        foreach ($data as $key => $value) {
            if (property_exists(self::class, $key)) {
                $this->{$key} = $value;
            }
        }

        return $this;
    }

    public function build(): ForecastDay
    {
        return new ForecastDay(get_object_vars($this));
    }

    /**
     * @return array<string, int|string|Day>
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
