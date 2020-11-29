<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Infrastructure\Client\Http\Deserializer;

use Tui\Weather\ApiClient\Infrastructure\Client\Exception\MalformedDeserializationException;

class Deserializer implements DeserializerInterface
{
    /**
     * @param string $content
     *
     * @throws MalformedDeserializationException
     *
     * @return array<string, string|int|float|null>
     */
    public function deserialize(string $content): array
    {
        $content = json_decode($content, true);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new MalformedDeserializationException(json_last_error_msg());
        }

        return $content;
    }
}
