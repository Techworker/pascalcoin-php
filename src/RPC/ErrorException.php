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

namespace Techworker\PascalCoin\RPC;

class ErrorException extends \Exception
{
    /**
     * Available error codes.
     */
    const ERR_INTERNAL = 100;
    const ERR_NOT_IMPLEMENTED = 101;
    const ERR_METHOD_NOT_FOUND = 1001;
    const ERR_INVALID_ACCOUNT = 1002;
    const ERR_INVALID_BLOCK = 1003;
    const ERR_INVALID_OPERATION = 1004;
    const ERR_INVALID_PUBKEY = 1005;
    const ERR_INVALID_ACCOUNT_NAME = 1006;
    const ERR_NOT_FOUND = 1010;
    const ERR_WALLET_PASSWORD_PROTECTED = 1015;
    const ERR_INVALID_DATA = 1016;
    const ERR_INVALID_SIGNATURE = 1020;
    const ERR_NOT_ALLOWED_CALL = 1021;

    /**
     * Unknown error code given by the remote endpoint.
     */
    const ERR_UNKNOWN = 0;

    /**
     * All error codes.
     */
    const ERR_ALL = [
        self::ERR_INTERNAL,
        self::ERR_NOT_IMPLEMENTED,
        self::ERR_METHOD_NOT_FOUND,
        self::ERR_INVALID_ACCOUNT,
        self::ERR_INVALID_BLOCK,
        self::ERR_INVALID_OPERATION,
        self::ERR_INVALID_PUBKEY,
        self::ERR_INVALID_ACCOUNT_NAME,
        self::ERR_NOT_FOUND,
        self::ERR_WALLET_PASSWORD_PROTECTED,
        self::ERR_INVALID_DATA,
        self::ERR_INVALID_SIGNATURE,
        self::ERR_NOT_ALLOWED_CALL,
    ];

    /**
     * Gets a value indicating whether the error code is known.
     *
     * @return bool
     */
    public function isKnownError()
    {
        return in_array($this->code, self::ERR_ALL);
    }
}
