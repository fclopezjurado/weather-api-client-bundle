<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Infrastructure\Client\Http;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpClient\HttplugClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Tui\Weather\ApiClient\Domain\Shared\Model\AbstractEntity;
use Tui\Weather\ApiClient\Infrastructure\Client\Exception\BadGatewayException;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Denormalizer\DenormalizerInterface;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Deserializer\DeserializerInterface;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Visitors\ResponseVisitorInterface;

class HttpClient extends AbstractHttpClient
{
    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @var DeserializerInterface
     */
    protected $deserializer;

    /**
     * @var DenormalizerInterface
     */
    protected $denormalizer;

    /**
     * @var ResponseVisitorInterface
     */
    protected $responseVisitor;

    /**
     * HttpClient constructor.
     *
     * @param DeserializerInterface    $deserializer
     * @param DenormalizerInterface    $denormalizer
     * @param ResponseVisitorInterface $responseVisitor
     * @param string                   $endpoint
     */
    public function __construct(
        DeserializerInterface $deserializer,
        DenormalizerInterface $denormalizer,
        ResponseVisitorInterface $responseVisitor,
        string $endpoint
    ) {
        $this->deserializer = $deserializer;
        $this->denormalizer = $denormalizer;
        $this->responseVisitor = $responseVisitor;
        $this->endpoint = $endpoint;
        $this->client = new HttplugClient();
    }

    /**
     * @param float $latitude
     * @param float $longitude
     *
     * @throws \Exception
     *
     * @return AbstractEntity
     */
    public function getForecast(float $latitude, float $longitude): AbstractEntity
    {
        $uri = sprintf($this->endpoint, $latitude, $longitude);
        /** @var array[] $responseData */
        $responseData = $this->sendRequest(Request::METHOD_GET, $uri);

        return $this->denormalizer->accept($this->responseVisitor, $responseData);
    }

    /**
     * @param string $method
     * @param string $uri
     *
     * @throws \Exception
     *
     * @return array<string, float|int|string|array|null>
     */
    protected function sendRequest(string $method, string $uri): array
    {
        $response = $this->request(
            $method,
            $uri,
            function (ResponseInterface $response) {
                return $response;
            },
            function (\Throwable $exception) {
                throw $exception;
            }
        );

        if (Response::HTTP_OK !== $response->getStatusCode()) {
            throw new BadGatewayException();
        }

        return $this->deserializer->deserialize($response->getBody()->getContents());
    }
}
