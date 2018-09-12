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

/**
 * Class PascalCurrency.
 *
 * This type is used to store pascal currency values. They are stored in molina
 * (*10000) and as a string. You can use bcmath or gmp to calculate with the
 * value.
 */
class PascalCurrency
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
        // remove all thousand seps
        $value = implode('', explode(',', $value));
        $parts = explode('.', $value);
        $value = $parts[0];
        if (!isset($parts[1])) {
            $parts[1] = '';
        }
        $value .= str_pad($parts[1], 4, '0', STR_PAD_RIGHT);
        $value = ltrim($value, '0');
        if ('' === $value) {
            $value = '0';
        }

        $this->value = $value;
    }

    public static function fromMolinas(string $molinas)
    {
        $instance = new self('0');
        // overwrite value
        $instance->value = $molinas;

        return $instance;
    }

    /**
     * Gets the pascal currency value as molinas.
     *
     * @return string
     */
    public function getMolinas(): string
    {
        return $this->value;
    }

    /**
     * Gets the pascal currency value as molinas.
     *
     * @return string
     */
    public function getPascal(): string
    {
        $value = $this->value;
        $negative = '';
        if ('-' === substr($value, 0, 1)) {
            $negative = '-';
            $value = substr($value, 1);
        }

        if (\strlen($value) <= 4) {
            return $negative.'0.'.str_pad($value, 4, '0', STR_PAD_LEFT);
        }

        return $negative.substr($value, 0, -4).'.'.substr($value, -4);
    }

    /**
     * Gets the pascal value.
     *
     * @return string
     */
    public function toString(): string
    {
        return $this->getPascal();
    }
}
