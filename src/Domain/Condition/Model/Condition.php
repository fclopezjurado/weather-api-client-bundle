<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Domain\Condition\Model;

use Tui\Weather\ApiClient\Domain\Shared\Model\AbstractEntity;

class Condition extends AbstractEntity
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $icon;

    /**
     * @var int
     */
    protected $code;

    public function __construct(string $text, string $icon, int $code)
    {
        $this->text = $text;
        $this->icon = $icon;
        $this->code = $code;
    }

    public function __get(string $name): mixed
    {
        return $this->{$name};
    }
}
