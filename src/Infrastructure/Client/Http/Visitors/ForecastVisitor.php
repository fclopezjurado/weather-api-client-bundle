<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Infrastructure\Client\Http\Visitors;

use Tui\Weather\ApiClient\Domain\Forecast\Service\ForecastBuilderInterface;
use Tui\Weather\ApiClient\Domain\Shared\Model\AbstractEntity;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Denormalizer\DenormalizerInterface;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Normalizer\CamelCaseToSnakeCaseNormalizerInterface;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Validator\ValidatorInterface;

class ForecastVisitor implements ForecastVisitorInterface
{
    /**
     * @var ForecastDayVisitorInterface
     */
    protected $forecastDayVisitor;

    /**
     * @var ForecastBuilderInterface
     */
    protected $forecastBuilder;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var CamelCaseToSnakeCaseNormalizerInterface
     */
    protected $normalizer;

    public function __construct(
        ForecastDayVisitorInterface $forecastDayVisitor,
        ForecastBuilderInterface $forecastBuilder,
        ValidatorInterface $validator,
        CamelCaseToSnakeCaseNormalizerInterface $normalizer
    ) {
        $this->forecastDayVisitor = $forecastDayVisitor;
        $this->forecastBuilder = $forecastBuilder;
        $this->validator = $validator;
        $this->normalizer = $normalizer;
    }

    public function denormalize(DenormalizerInterface $denormalizer, array $normalizedData): AbstractEntity
    {
        $validKeys = array_keys($this->forecastBuilder->toArray());
        $keysToValidate = array_keys($normalizedData);

        $this->validator->arrayKeysExist($this->normalizer, $keysToValidate, $validKeys);
        /** @var array[] $forecasts */
        $forecasts = $normalizedData['forecastday'];

        $denormalizedData = [
            'forecastday' => array_map(function ($cityData) use ($denormalizer) {
                return $denormalizer->accept($this->forecastDayVisitor, $cityData);
            }, $forecasts),
        ];

        return $this->forecastBuilder
            ->fromArray($denormalizedData)
            ->build()
        ;
    }
}
