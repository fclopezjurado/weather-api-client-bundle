<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Infrastructure\Client\Http\Normalizer;

interface CamelCaseToSnakeCaseNormalizerInterface
{
    /**
     * @param string[] $keys
     *
     * @return string[]
     */
    public function normalize(array $keys): array;

    /**
     * @param array<string, float|int|string|array|null> $normalizedData
     *
     * @return array<string, float|int|string|array|null>
     */
    public function denormalize(array $normalizedData): array;
}
