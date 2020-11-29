<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Infrastructure\Client\Http\Visitors;

use Tui\Weather\ApiClient\Domain\Condition\Service\ConditionBuilderInterface;
use Tui\Weather\ApiClient\Domain\Shared\Model\AbstractEntity;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Denormalizer\DenormalizerInterface;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Normalizer\CamelCaseToSnakeCaseNormalizerInterface;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Validator\ValidatorInterface;

class ConditionVisitor implements ConditionVisitorInterface
{
    /**
     * @var ConditionBuilderInterface
     */
    protected $conditionBuilder;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var CamelCaseToSnakeCaseNormalizerInterface
     */
    protected $normalizer;

    public function __construct(
        ConditionBuilderInterface $conditionBuilder,
        ValidatorInterface $validator,
        CamelCaseToSnakeCaseNormalizerInterface $normalizer
    ) {
        $this->conditionBuilder = $conditionBuilder;
        $this->validator = $validator;
        $this->normalizer = $normalizer;
    }

    /**
     * {@inheritdoc}
     */
    public function denormalize(DenormalizerInterface $denormalizer, array $normalizedData): AbstractEntity
    {
        $validKeys = array_keys($this->conditionBuilder->toArray());
        $keysToValidate = array_keys($normalizedData);

        $this->validator->arrayKeysExist($this->normalizer, $keysToValidate, $validKeys);

        /** @var array<string, int|string> $denormalizedData */
        $denormalizedData = $this->normalizer->denormalize($normalizedData);

        return $this->conditionBuilder
            ->fromArray($denormalizedData)
            ->build()
        ;
    }
}
