<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Infrastructure\Client\Http\Visitors;

use Tui\Weather\ApiClient\Domain\Day\Model\Day;
use Tui\Weather\ApiClient\Domain\ForecastDay\Service\ForecastDayBuilderInterface;
use Tui\Weather\ApiClient\Domain\Shared\Model\AbstractEntity;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Denormalizer\DenormalizerInterface;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Normalizer\CamelCaseToSnakeCaseNormalizerInterface;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Validator\ValidatorInterface;

class ForecastDayVisitor implements ForecastDayVisitorInterface
{
    /**
     * @var DayVisitorInterface
     */
    protected $dayVisitor;

    /**
     * @var ForecastDayBuilderInterface
     */
    protected $forecastDayBuilder;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var CamelCaseToSnakeCaseNormalizerInterface
     */
    protected $normalizer;

    public function __construct(
        DayVisitorInterface $dayVisitor,
        ForecastDayBuilderInterface $forecastDayBuilder,
        ValidatorInterface $validator,
        CamelCaseToSnakeCaseNormalizerInterface $normalizer
    ) {
        $this->dayVisitor = $dayVisitor;
        $this->forecastDayBuilder = $forecastDayBuilder;
        $this->validator = $validator;
        $this->normalizer = $normalizer;
    }

    public function denormalize(DenormalizerInterface $denormalizer, array $normalizedData): AbstractEntity
    {
        $validKeys = array_keys($this->forecastDayBuilder->toArray());
        $keysToValidate = array_keys($normalizedData);

        $this->validator->arrayKeysExist($this->normalizer, $keysToValidate, $validKeys);

        /** @var Day $day */
        $day = $denormalizer->accept($this->dayVisitor, $normalizedData['day']);
        $denormalizedData = $this->normalizer->denormalize($normalizedData);
        $denormalizedData['day'] = $day;

        return $this->forecastDayBuilder
            ->fromArray($denormalizedData)
            ->build()
        ;
    }
}
