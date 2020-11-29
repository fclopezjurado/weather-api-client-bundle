<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Domain\Current\Model;

use Tui\Weather\ApiClient\Domain\Condition\Model\Condition;
use Tui\Weather\ApiClient\Domain\Shared\Model\AbstractEntity;

/**
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class Current extends AbstractEntity
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

    public function __get(string $name): mixed
    {
        return $this->{$name};
    }
}
