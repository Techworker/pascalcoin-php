<?php
/**
 * Copyright (c) Benjamin Ansbach - all rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

/*
 * This file is part of the PascalCoin PHP package.
 *
 * (c) Benjamin Ansbach <benjaminansbach@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Techworker\PascalCoin\Type\Simple;

use Techworker\PascalCoin\Type\RpcValueInterface;

/**
 * Class HexaString.
 *
 * This type is used to store a hexadecimal string used in PascalCoin.
 */
class HexaString implements RpcValueInterface
{
    /**
     * The hex value.
     *
     * @var string
     */
    protected $value;

    /**
     * HexaString constructor.
     *
     * @param string $value
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(string $value)
    {
        if ('' !== $value && !preg_match('/^[0-9A-Fa-f]+$/', $value)) {
            throw new \InvalidArgumentException('Invalid hexadecimal string');
        }

        if (0 !== \strlen($value) % 2) {
            throw new \InvalidArgumentException('Uneven hexadecimal string');
        }

        $this->value = $value;
    }

    /**
     * Gets the hex value as string.
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Gets the string value.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * Gets the ascii representation.
     *
     * @return string
     */
    public function toAscii(): string
    {
        $ascii = '';
        $length = \strlen($this->value);
        for ($position = 0; $position < $length; $position += 2) {
            $ascii .= \chr(\hexdec(\substr($this->value, $position, 2)));
        }

        return $ascii;
    }
}
