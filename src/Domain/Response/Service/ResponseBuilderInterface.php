<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Domain\Response\Service;

use Tui\Weather\ApiClient\Domain\Response\Model\Response;
use Tui\Weather\ApiClient\Domain\Shared\Model\AbstractEntity;

interface ResponseBuilderInterface
{
    /**
     * @param array<string, AbstractEntity> $data
     *
     * @return $this|ResponseBuilderInterface
     */
    public function fromArray(array $data): self;

    public function build(): Response;

    /**
     * @return array<string, AbstractEntity>
     */
    public function toArray(): array;
}
