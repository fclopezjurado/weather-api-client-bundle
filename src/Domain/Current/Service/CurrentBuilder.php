<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Domain\Current\Service;

use Tui\Weather\ApiClient\Domain\Condition\Model\Condition;
use Tui\Weather\ApiClient\Domain\Current\Model\Current;

/**
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class CurrentBuilder implements CurrentBuilderInterface
{
    /**
     * @var int
     */
    protected $lastUpdatedEpoch;

    /**
     * @var string
     */
    protected $lastUpdated;

    /**
     * @var float
     */
    protected $tempC;

    /**
     * @var float
     */
    protected $tempF;

    /**
     * @var int
     */
    protected $isDay;

    /**
     * @var Condition
     */
    protected $condition;

    /**
     * @var float
     */
    protected $windMph;

    /**
     * @var float
     */
    protected $windKph;

    /**
     * @var int
     */
    protected $windDegree;

    /**
     * @var string
     */
    protected $windDir;

    /**
     * @var float
     */
    protected $pressureMb;

    /**
     * @var float
     */
    protected $pressureIn;

    /**
     * @var float
     */
    protected $precipMm;

    /**
     * @var float
     */
    protected $precipIn;

    /**
     * @var int
     */
    protected $humidity;

    /**
     * @var int
     */
    protected $cloud;

    /**
     * @var float
     */
    protected $feelslikeC;

    /**
     * @var float
     */
    protected $feelslikeF;

    /**
     * @var float
     */
    protected $visKm;

    /**
     * @var float
     */
    protected $visMiles;

    /**
     * @var float
     */
    protected $uv;

    /**
     * @var float
     */
    protected $gustMph;

    /**
     * @var float
     */
    protected $gustKph;

    /**
     * @param array<string, int|string|float|Condition> $data
     *
     * @return $this|CurrentBuilderInterface
     */
    public function fromArray(array $data): CurrentBuilderInterface
    {
        foreach ($data as $key => $value) {
            if (property_exists(self::class, $key)) {
                $this->{$key} = $value;
            }
        }

        return $this;
    }

    public function build(): Current
    {
        return new Current(get_object_vars($this));
    }

    /**
     * @return array<string, int|string|float|Condition>
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
