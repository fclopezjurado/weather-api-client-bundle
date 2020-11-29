<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Domain\Response\Service;

use Tui\Weather\ApiClient\Domain\Current\Model\Current;
use Tui\Weather\ApiClient\Domain\Forecast\Model\Forecast;
use Tui\Weather\ApiClient\Domain\Location\Model\Location;
use Tui\Weather\ApiClient\Domain\Response\Model\Response;

interface ResponseBuilderInterface
{
    /**
     * @param array<string, Location|Current|Forecast> $data
     *
     * @return $this|ResponseBuilderInterface
     */
    public function fromArray(array $data): self;

    public function build(): Response;

    /**
     * @return array<string, Location|Current|Forecast>
     */
    public function toArray(): array;
}
