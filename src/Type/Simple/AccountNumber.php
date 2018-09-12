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
 * Class AccountNumber.
 *
 * This type is used to handle an account number.
 */
class AccountNumber implements RpcValueInterface
{
    /**
     * The account number itself.
     *
     * @var int
     */
    protected $account;

    /**
     * The checksum of the account number.
     *
     * @var int
     */
    protected $checksum;

    /**
     * AccountNumber constructor.
     *
     * @param int|string|AccountNumber $account
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($account)
    {
        if ($account instanceof self) {
            $this->account = $account->account;
            $this->checksum = $account->checksum;
        } elseif (\is_string($account)) {
            $parts = explode('-', $account);
            if (2 === \count($parts)) {
                $this->account = (int) $parts[0];
                $this->checksum = (int) $parts[1];

                if ($this->checksum !== self::calculateChecksum($this->account)) {
                    throw new \InvalidArgumentException('Invalid checksum for account '.$this->account);
                }
            } else {
                // lets try our best
                $this->account = (int) $account;
                $this->checksum = self::calculateChecksum($this->account);
            }
        } else {
            $this->account = (int) $account;
            $this->checksum = self::calculateChecksum($this->account);
        }
    }

    /**
     * Calculates the checksum for the given account number.
     *
     * @param int $account
     * @returns int
     */
    public static function calculateChecksum(int $account): int
    {
        return (($account * 101) % 89) + 10;
    }

    /**
     * Gets the account number.
     *
     * @return int
     */
    public function getAccount(): int
    {
        return $this->account;
    }

    /**
     * Gets the checksum of the account number.
     *
     * @return int
     */
    public function getChecksum(): int
    {
        return $this->checksum;
    }

    /**
     * Gets the typical account number representation.
     *
     * @return string
     */
    public function __toString(): string
    {
        return sprintf('%d-%d', $this->account, $this->checksum);
    }

    /**
     * Gets the account number.
     *
     * @return int
     */
    public function getValue(): int
    {
        return $this->account;
    }
}
