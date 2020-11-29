<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Infrastructure\Client\Http\Normalizer;

use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter
    as SymfonyCamelCaseToSnakeCaseNameConverter;

class CamelCaseToSnakeCaseNormalizer implements CamelCaseToSnakeCaseNormalizerInterface
{
    /**
     * @var SymfonyCamelCaseToSnakeCaseNameConverter
     */
    protected $normalizer;

    public function __construct()
    {
        $this->normalizer = new SymfonyCamelCaseToSnakeCaseNameConverter();
    }

    /**
     * @param string[] $keys
     *
     * @return string[]
     */
    public function normalize(array $keys): array
    {
        return array_map(function ($key) {
            return $this->normalizer->normalize($key);
        }, $keys);
    }

    /**
     * @param array<string, float|int|string|array|null> $normalizedData
     *
     * @return array<string, float|int|string|array|null>
     */
    public function denormalize(array $normalizedData): array
    {
        $denormalizedData = [];

        foreach ($normalizedData as $key => $value) {
            $denormalizedKey = $this->normalizer->denormalize($key);
            $denormalizedData[$denormalizedKey] = $value;
        }

        return $denormalizedData;
    }
}
