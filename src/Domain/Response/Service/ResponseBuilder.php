<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Domain\Response\Service;

use Tui\Weather\ApiClient\Domain\Current\Model\Current;
use Tui\Weather\ApiClient\Domain\Forecast\Model\Forecast;
use Tui\Weather\ApiClient\Domain\Location\Model\Location;
use Tui\Weather\ApiClient\Domain\Response\Model\Response;

class ResponseBuilder implements ResponseBuilderInterface
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

    /**
     * @param array<string, Location|Current|Forecast> $data
     *
     * @return $this|ResponseBuilderInterface
     */
    public function fromArray(array $data): ResponseBuilderInterface
    {
        foreach ($data as $key => $value) {
            if (property_exists(self::class, $key)) {
                $this->{$key} = $value;
            }
        }

        return $this;
    }

    public function build(): Response
    {
        return new Response($this->location, $this->current, $this->forecast);
    }

    /**
     * @return array<string, Location|Current|Forecast>
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
