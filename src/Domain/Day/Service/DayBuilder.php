<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Domain\Day\Service;

use Tui\Weather\ApiClient\Domain\Condition\Model\Condition;
use Tui\Weather\ApiClient\Domain\Day\Model\Day;

/**
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class DayBuilder implements DayBuilderInterface
{
    /**
     * @var float
     */
    protected $maxtempC;

    /**
     * @var float
     */
    protected $maxtempF;

    /**
     * @var float
     */
    protected $mintempC;

    /**
     * @var float
     */
    protected $mintempF;

    /**
     * @var float
     */
    protected $avgtempC;

    /**
     * @var float
     */
    protected $avgtempF;

    /**
     * @var float
     */
    protected $maxwindMph;

    /**
     * @var float
     */
    protected $maxwindKph;

    /**
     * @var float
     */
    protected $totalprecipMm;

    /**
     * @var float
     */
    protected $totalprecipIn;

    /**
     * @var float
     */
    protected $avgvisKm;

    /**
     * @var float
     */
    protected $avgvisMiles;

    /**
     * @var float
     */
    protected $avghumidity;

    /**
     * @var int
     */
    protected $dailyWillItRain;

    /**
     * @var string
     */
    protected $dailyChanceOfRain;

    /**
     * @var int
     */
    protected $dailyWillItSnow;

    /**
     * @var string
     */
    protected $dailyChanceOfSnow;

    /**
     * @var Condition
     */
    protected $condition;

    /**
     * @var float
     */
    protected $uv;

    /**
     * @param array<string, int|string|float|Condition> $data
     *
     * @return $this|DayBuilderInterface
     */
    public function fromArray(array $data): DayBuilderInterface
    {
        foreach ($data as $key => $value) {
            if (property_exists(self::class, $key)) {
                $this->{$key} = $value;
            }
        }

        return $this;
    }

    public function build(): Day
    {
        return new Day(get_object_vars($this));
    }

    /**
     * @return array<string, int|string|float|Condition>
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
