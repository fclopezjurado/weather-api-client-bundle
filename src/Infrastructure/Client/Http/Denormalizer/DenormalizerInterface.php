<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Infrastructure\Client\Http\Denormalizer;

use Tui\Weather\ApiClient\Domain\Shared\Model\AbstractEntity;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Visitors\VisitorInterface;

interface DenormalizerInterface
{
    /**
     * @param VisitorInterface                           $visitor
     * @param array<string, float|int|string|array|null> $normalizedData
     *
     * @return AbstractEntity
     */
    public function accept(VisitorInterface $visitor, array $normalizedData): AbstractEntity;
}
