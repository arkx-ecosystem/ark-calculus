<?php

declare(strict_types=1);

/*
 * This file is part of Ark Calculus.
 *
 * (c) ArkX <hello@arkx.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ArkX\Calculus;

use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;

/**
 * This is the big number class.
 *
 * @author Brian Faust <hello@brianfaust.me>
 */
class BigNumber
{
    /**
     * @var int
     */
    const ARKTOSHI = 1e8;

    /**
     * @var int
     */
    const SCALE = 0;

    /**
     * @var int
     */
    const ROUNDING = RoundingMode::HALF_DOWN;

    /**
     * Create a new instance.
     *
     * @param \Brick\Math\BigDecimal $value
     */
    private function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Create a new instance.
     *
     * @param \Brick\Math\BigDecimal $value
     *
     * @return \App\Math\BigNumber
     */
    public static function create($value): BigNumber
    {
        return new static(static::fromString($value));
    }

    /**
     * Create a new "Decimal" instance from a string.
     *
     * @param \Brick\Math\BigDecimal $value
     *
     * @return \Brick\Math\BigDecimal
     */
    public static function fromString($value): BigDecimal
    {
        if ($value instanceof Decimal) {
            return $value;
        }

        return BigDecimal::of((string) $value);
    }

    /**
     * Add the given value to the current value.
     *
     * @param \Brick\Math\BigDecimal $value
     *
     * @return \App\Math\BigNumber
     */
    public function plus($value): BigNumber
    {
        return new static($this->value->plus(static::fromString($value)));
    }

    /**
     * Subtract the given value to the current value.
     *
     * @param \Brick\Math\BigDecimal $value
     *
     * @return \App\Math\BigNumber
     */
    public function minus($value): BigNumber
    {
        return new static($this->value->minus(static::fromString($value)));
    }

    /**
     * Multiply the current value by the given value.
     *
     * @param \Brick\Math\BigDecimal $value
     *
     * @return \App\Math\BigNumber
     */
    public function times($value): BigNumber
    {
        return new static($this->value->multipliedBy(static::fromString($value)));
    }

    /**
     * Divide the current value by the given value.
     *
     * @param \Brick\Math\BigDecimal $value
     *
     * @return \App\Math\BigNumber
     */
    public function dividedBy($value): BigNumber
    {
        return new static($this->value->dividedBy(static::fromString($value), self::SCALE, self::ROUNDING));
    }

    /**
     * Get a float representation of the object.
     *
     * @return float
     */
    public function toFloat(): float
    {
        return $this->value->toFloat();
    }

    /**
     * Get an integer representation of the object.
     *
     * @return int
     */
    public function toInteger(): int
    {
        return $this->value->toInt();
    }

    /**
     * Get a string representation of the object.
     *
     * @return string
     */
    public function toString(): string
    {
        return (string) $this->value;
    }

    /**
     * Get a human representation of the object.
     *
     * @return string
     */
    public function toHuman(): string
    {
        return (string) $this->value->dividedBy(static::fromString(self::ARKTOSHI), self::SCALE, self::ROUNDING);
    }
}
