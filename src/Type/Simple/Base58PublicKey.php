<?php

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

/**
 * Class Base58PublicKeyInterface.
 *
 * A single Base 58 public key value.
 */
class Base58PublicKey implements PublicKeyInterface
{
    /**
     * The base58 encoded public key.
     *
     * @var string
     */
    protected $value;

    /**
     * Base58PublicKeyInterface constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        if ($value instanceof self) {
            $this->value = $value;
        } else {
            $this->value = $value;
        }
    }

    /**
     * Gets the base58 key.
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Gets the value as a string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }
}
