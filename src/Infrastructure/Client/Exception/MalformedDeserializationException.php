<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Infrastructure\Client\Exception;

use Exception;

class MalformedDeserializationException extends Exception
{
    protected const DEFAULT_MESSAGE = 'Response data could not be deserialized';

    public function __construct(string $message = self::DEFAULT_MESSAGE)
    {
        parent::__construct($message);
    }
}
