<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Domain\Location\Service;

use Tui\Weather\ApiClient\Domain\Location\Model\Location;

class LocationBuilder implements LocationBuilderInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $region;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var float
     */
    protected $lat;

    /**
     * @var float
     */
    protected $lon;

    /**
     * @var string
     */
    protected $tzId;

    /**
     * @var int
     */
    protected $localtimeEpoch;

    /**
     * @var string
     */
    protected $localtime;

    /**
     * @param array<string, int|string|float> $data
     *
     * @return $this|LocationBuilderInterface
     */
    public function fromArray(array $data): LocationBuilderInterface
    {
        foreach ($data as $key => $value) {
            if (property_exists(self::class, $key)) {
                $this->{$key} = $value;
            }
        }

        return $this;
    }

    public function build(): Location
    {
        return new Location(get_object_vars($this));
    }

    /**
     * @return array<string, int|string|float>
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
