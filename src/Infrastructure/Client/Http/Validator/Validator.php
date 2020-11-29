<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Infrastructure\Client\Http\Validator;

use Tui\Weather\ApiClient\Infrastructure\Client\Exception\MalformedDeserializationException;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Normalizer\CamelCaseToSnakeCaseNormalizerInterface;

class Validator implements ValidatorInterface
{
    /**
     * @param CamelCaseToSnakeCaseNormalizerInterface $normalizer
     * @param string[]                                $keysToValidate
     * @param string[]                                $validKeys
     *
     * @throws MalformedDeserializationException
     */
    public function arrayKeysExist(
        CamelCaseToSnakeCaseNormalizerInterface $normalizer,
        array $keysToValidate,
        array $validKeys
    ): void {
        $normalizedValidKeys = $normalizer->normalize($validKeys);
        $intersection = array_intersect($keysToValidate, $normalizedValidKeys);

        if (\count($intersection) !== \count($keysToValidate)) {
            throw new MalformedDeserializationException();
        }
    }
}
