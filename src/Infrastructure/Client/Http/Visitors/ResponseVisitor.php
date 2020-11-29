<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Infrastructure\Client\Http\Visitors;

use Tui\Weather\ApiClient\Domain\Response\Service\ResponseBuilderInterface;
use Tui\Weather\ApiClient\Domain\Shared\Model\AbstractEntity;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Denormalizer\DenormalizerInterface;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Normalizer\CamelCaseToSnakeCaseNormalizerInterface;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Validator\ValidatorInterface;

class ResponseVisitor implements ResponseVisitorInterface
{
    /**
     * @var LocationVisitorInterface
     */
    protected $locationVisitor;

    /**
     * @var CurrentVisitorInterface
     */
    protected $currentVisitor;

    /**
     * @var ForecastVisitorInterface
     */
    protected $forecastVisitor;

    /**
     * @var ResponseBuilderInterface
     */
    protected $responseBuilder;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var CamelCaseToSnakeCaseNormalizerInterface
     */
    protected $normalizer;

    public function __construct(
        LocationVisitorInterface $locationVisitor,
        CurrentVisitorInterface $currentVisitor,
        ForecastVisitorInterface $forecastVisitor,
        ResponseBuilderInterface $responseBuilder,
        ValidatorInterface $validator,
        CamelCaseToSnakeCaseNormalizerInterface $normalizer
    ) {
        $this->locationVisitor = $locationVisitor;
        $this->currentVisitor = $currentVisitor;
        $this->forecastVisitor = $forecastVisitor;
        $this->responseBuilder = $responseBuilder;
        $this->validator = $validator;
        $this->normalizer = $normalizer;
    }

    public function denormalize(DenormalizerInterface $denormalizer, array $normalizedData): AbstractEntity
    {
        $validKeys = array_keys($this->responseBuilder->toArray());
        $keysToValidate = array_keys($normalizedData);

        $this->validator->arrayKeysExist($this->normalizer, $keysToValidate, $validKeys);

        $denormalizedData = [
            'location' => $denormalizer->accept($this->locationVisitor, $normalizedData['location']),
            'current' => $denormalizer->accept($this->currentVisitor, $normalizedData['location']),
            'forecast' => $denormalizer->accept($this->forecastVisitor, $normalizedData['forecast']),
        ];

        return $this->responseBuilder
            ->fromArray($denormalizedData)
            ->build()
        ;
    }
}
