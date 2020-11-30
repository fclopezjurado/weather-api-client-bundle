<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Infrastructure\Client\Http\Visitors;

use Tui\Weather\ApiClient\Domain\Condition\Model\Condition;
use Tui\Weather\ApiClient\Domain\Day\Service\DayBuilderInterface;
use Tui\Weather\ApiClient\Domain\Shared\Model\AbstractEntity;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Denormalizer\DenormalizerInterface;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Normalizer\CamelCaseToSnakeCaseNormalizerInterface;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Validator\ValidatorInterface;

class DayVisitor implements DayVisitorInterface
{
    /**
     * @var ConditionVisitorInterface
     */
    protected $conditionVisitor;

    /**
     * @var DayBuilderInterface
     */
    protected $dayBuilder;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var CamelCaseToSnakeCaseNormalizerInterface
     */
    protected $normalizer;

    public function __construct(
        ConditionVisitorInterface $conditionVisitor,
        DayBuilderInterface $dayBuilder,
        ValidatorInterface $validator,
        CamelCaseToSnakeCaseNormalizerInterface $normalizer
    ) {
        $this->conditionVisitor = $conditionVisitor;
        $this->dayBuilder = $dayBuilder;
        $this->validator = $validator;
        $this->normalizer = $normalizer;
    }

    public function denormalize(DenormalizerInterface $denormalizer, array $normalizedData): AbstractEntity
    {
        $validKeys = array_keys($this->dayBuilder->toArray());
        $keysToValidate = array_keys($normalizedData);

        $this->validator->arrayKeysExist($this->normalizer, $keysToValidate, $validKeys);
        /** @var array<string, array|float|int|string|null> $conditionData */
        $conditionData = $normalizedData['condition'];

        /** @var Condition $condition */
        $condition = $denormalizer->accept($this->conditionVisitor, $conditionData);
        $denormalizedData = $this->normalizer->denormalize($normalizedData);
        $denormalizedData['condition'] = $condition;

        return $this->dayBuilder
            ->fromArray($denormalizedData)
            ->build()
        ;
    }
}
