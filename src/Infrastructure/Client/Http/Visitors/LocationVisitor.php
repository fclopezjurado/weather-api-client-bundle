<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Infrastructure\Client\Http\Visitors;

use Tui\Weather\ApiClient\Domain\Location\Service\LocationBuilderInterface;
use Tui\Weather\ApiClient\Domain\Shared\Model\AbstractEntity;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Denormalizer\DenormalizerInterface;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Normalizer\CamelCaseToSnakeCaseNormalizerInterface;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Validator\ValidatorInterface;

class LocationVisitor implements LocationVisitorInterface
{
    /**
     * @var LocationBuilderInterface
     */
    protected $locationBuilder;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var CamelCaseToSnakeCaseNormalizerInterface
     */
    protected $normalizer;

    public function __construct(
        LocationBuilderInterface $locationBuilder,
        ValidatorInterface $validator,
        CamelCaseToSnakeCaseNormalizerInterface $normalizer
    ) {
        $this->locationBuilder = $locationBuilder;
        $this->validator = $validator;
        $this->normalizer = $normalizer;
    }

    public function denormalize(DenormalizerInterface $denormalizer, array $normalizedData): AbstractEntity
    {
        $validKeys = array_keys($this->locationBuilder->toArray());
        $keysToValidate = array_keys($normalizedData);

        $this->validator->arrayKeysExist($this->normalizer, $keysToValidate, $validKeys);

        $denormalizedData = $this->normalizer->denormalize($normalizedData);

        return $this->locationBuilder
            ->fromArray($denormalizedData)
            ->build()
        ;
    }
}
