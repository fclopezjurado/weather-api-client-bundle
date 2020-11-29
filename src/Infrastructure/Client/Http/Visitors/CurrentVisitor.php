<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Infrastructure\Client\Http\Visitors;

use Tui\Weather\ApiClient\Domain\Condition\Model\Condition;
use Tui\Weather\ApiClient\Domain\Current\Service\CurrentBuilderInterface;
use Tui\Weather\ApiClient\Domain\Shared\Model\AbstractEntity;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Denormalizer\DenormalizerInterface;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Normalizer\CamelCaseToSnakeCaseNormalizerInterface;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Validator\ValidatorInterface;

class CurrentVisitor implements CurrentVisitorInterface
{
    /**
     * @var ConditionVisitorInterface
     */
    protected $conditionVisitor;

    /**
     * @var CurrentBuilderInterface
     */
    protected $currentBuilder;

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
        CurrentBuilderInterface $currentBuilder,
        ValidatorInterface $validator,
        CamelCaseToSnakeCaseNormalizerInterface $normalizer
    ) {
        $this->conditionVisitor = $conditionVisitor;
        $this->currentBuilder = $currentBuilder;
        $this->validator = $validator;
        $this->normalizer = $normalizer;
    }

    public function denormalize(DenormalizerInterface $denormalizer, array $normalizedData): AbstractEntity
    {
        $validKeys = array_keys($this->currentBuilder->toArray());
        $keysToValidate = array_keys($normalizedData);

        $this->validator->arrayKeysExist($this->normalizer, $keysToValidate, $validKeys);

        /** @var Condition $condition */
        $condition = $denormalizer->accept($this->conditionVisitor, $normalizedData['condition']);
        $denormalizedData = $this->normalizer->denormalize($normalizedData);
        $denormalizedData['condition'] = $condition;

        return $this->currentBuilder
            ->fromArray($denormalizedData)
            ->build()
        ;
    }
}
