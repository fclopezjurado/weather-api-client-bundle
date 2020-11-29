<?php

declare(strict_types=1);

namespace Tui\Weather\ApiClient\Domain\Condition\Service;

use Tui\Weather\ApiClient\Domain\Condition\Model\Condition;

class ConditionBuilder implements ConditionBuilderInterface
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

    /**
     * @param array<string, int|string> $data
     *
     * @return $this|ConditionBuilderInterface
     */
    public function fromArray(array $data): ConditionBuilderInterface
    {
        foreach ($data as $key => $value) {
            if (property_exists(self::class, $key)) {
                $this->{$key} = $value;
            }
        }

        return $this;
    }

    public function build(): Condition
    {
        return new Condition($this->text, $this->icon, $this->code);
    }

    /**
     * @return array<string, int|string>
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
