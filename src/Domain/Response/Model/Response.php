<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Domain\Response\Model;

use Tui\Weather\ApiClient\Domain\Current\Model\Current;
use Tui\Weather\ApiClient\Domain\Forecast\Model\Forecast;
use Tui\Weather\ApiClient\Domain\Location\Model\Location;
use Tui\Weather\ApiClient\Domain\Shared\Model\AbstractEntity;

class Response extends AbstractEntity
{
    /**
     * @var Location
     */
    protected $location;

    /**
     * @var Current
     */
    protected $current;

    /**
     * @var Forecast
     */
    protected $forecast;

    public function __construct(Location $location, Current $current, Forecast $forecast)
    {
        $this->location = $location;
        $this->current = $current;
        $this->forecast = $forecast;
    }

    public function __get(string $name): mixed
    {
        return $this->{$name};
    }
}
