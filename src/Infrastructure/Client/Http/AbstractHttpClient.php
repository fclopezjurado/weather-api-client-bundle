<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Infrastructure\Client\Http;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpClient\HttplugClient;

abstract class AbstractHttpClient
{
    /**
     * @var HttplugClient
     */
    protected $client;

    /**
     * @param string   $method
     * @param string   $uri
     * @param callable $onFullFilled
     * @param callable $onRejected
     *
     * @throws \Exception
     *
     * @return ResponseInterface
     */
    public function request(
        string $method,
        string $uri,
        callable $onFullFilled,
        callable $onRejected
    ): ResponseInterface {
        $request = $this->client->createRequest($method, $uri);
        $promise = $this->client->sendAsyncRequest($request)
            ->then($onFullFilled, $onRejected)
        ;

        return $promise->wait();
    }
}
