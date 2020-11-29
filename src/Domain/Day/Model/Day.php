<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Domain\Day\Model;

use Tui\Weather\ApiClient\Domain\Condition\Model\Condition;
use Tui\Weather\ApiClient\Domain\Shared\Model\AbstractEntity;

/**
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class Day extends AbstractEntity
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
     * @param array<string, int|string|float|Condition> $parameters
     */
    public function __construct(array $parameters)
    {
        foreach ($parameters as $name => $value) {
            if (property_exists(self::class, $name)) {
                $this->{$name} = $value;
            }
        }
    }

    public function condition(): Condition
    {
        return $this->condition;
    }
}
