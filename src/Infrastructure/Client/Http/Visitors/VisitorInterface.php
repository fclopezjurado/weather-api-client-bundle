<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Infrastructure\Client\Http\Visitors;

use Tui\Weather\ApiClient\Domain\Shared\Model\AbstractEntity;
use Tui\Weather\ApiClient\Infrastructure\Client\Exception\MalformedDeserializationException;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Denormalizer\DenormalizerInterface;

interface VisitorInterface
{
    /**
     * @param DenormalizerInterface                      $denormalizer
     * @param array<string, float|int|string|array|null> $normalizedData
     *
     * @throws MalformedDeserializationException
     *
     * @return AbstractEntity
     */
    public function denormalize(DenormalizerInterface $denormalizer, array $normalizedData): AbstractEntity;
}
