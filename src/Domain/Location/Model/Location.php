<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Domain\Location\Model;

use Tui\Weather\ApiClient\Domain\Shared\Model\AbstractEntity;

class Location extends AbstractEntity
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
     * @var int
     */
    protected $lat;

    /**
     * @var int
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
     * @param array<string, int|string> $parameters
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
