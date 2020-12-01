<?php

declare(strict_types=1);

namespace Tui\Musement\ApiClient\Tests\Infrastructure\Client\Http;

use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Response;
use Tui\Weather\ApiClient\Infrastructure\Client\Exception\BadGatewayException;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Denormalizer\DenormalizerInterface;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Deserializer\DeserializerInterface;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\HttpClient;
use Tui\Weather\ApiClient\Infrastructure\Client\Http\Visitors\ResponseVisitorInterface;

class HttpClientTest extends TestCase
{
    public function testShouldThrowExceptionWhenGetForecast(): void
    {
        $this->expectException(\Exception::class);

        /** @var HttpClient $client */
        $client = $this->getHttpClientMock();

        $client->getForecast(1, 2);
    }

    public function testShouldThrowBadGatewayExceptionWhenGetForecast(): void
    {
        $this->expectException(BadGatewayException::class);

        $responseMock = $this->getResponseMock(Response::HTTP_NOT_FOUND);
        /** @var HttpClient $client */
        $client = $this->getHttpClientMock($responseMock);

        $client->getForecast(1, 2);
    }

    protected function getHttpClientMock(MockObject $responseMock = null): MockObject
    {
        $mocks = [
            'weatherApiKey' => '',
            'deserializerMock' => $this->createMock(DeserializerInterface::class),
            'denormalizerMock' => $this->createMock(DenormalizerInterface::class),
            'responseVisitorMock' => $this->createMock(ResponseVisitorInterface::class),
            'endpoint' => '',
        ];
        $httpClientMock = $this->getMockBuilder(HttpClient::class)
            ->setConstructorArgs($mocks)
            ->onlyMethods(['request'])
            ->getMock()
        ;
        $invocationMocker = $httpClientMock->expects($this->any())
            ->method('request')
        ;

        if (null === $responseMock) {
            $invocationMocker->willThrowException(new Exception());

            return $httpClientMock;
        }

        $invocationMocker->willReturn($responseMock);

        return $httpClientMock;
    }

    protected function getResponseMock(int $responseCode): MockObject
    {
        $mock = $this->createMock(ResponseInterface::class);

        $mock->method('getStatusCode')
            ->willReturn($responseCode)
        ;

        return $mock;
    }
}
