<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Domain\ForecastDay\Model;

use Tui\Weather\ApiClient\Domain\Day\Model\Day;
use Tui\Weather\ApiClient\Domain\Shared\Model\AbstractEntity;

class ForecastDay extends AbstractEntity
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
     * @param array<string, int|string|Day> $parameters
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
