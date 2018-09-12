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

namespace Techworker\PascalCoin\RichApi;

use Techworker\CryptoCurrency\Currencies\PascalCoin;
use Techworker\PascalCoin\Type\PublicKey;
use Techworker\PascalCoin\Type\Simple\PublicKeyInterface;

/**
 * Interface NodeApiInterface.
 */
interface WalletApiInterface
{
    /**
     * @throws \Techworker\PascalCoin\RPC\ConnectionException
     * @throws \Techworker\PascalCoin\RPC\ErrorException
     */
    public function accounts(PublicKeyInterface $publicKey,
                             int $start = 0,
                             int $max = 100): array;

    /**
     * @throws \Techworker\PascalCoin\RPC\ConnectionException
     * @throws \Techworker\PascalCoin\RPC\ErrorException
     */
    public function countAccounts(PublicKeyInterface $publicKey,
                                 int $start = 0,
                                 int $max = 100): int;

    /**
     * @throws \Techworker\PascalCoin\RPC\ConnectionException
     * @throws \Techworker\PascalCoin\RPC\ErrorException
     *
     * @return PublicKey[]
     */
    public function publicKeys(int $start = 0,
                               int $max = 100): array;

    /**
     * @throws \Techworker\PascalCoin\RPC\ConnectionException
     * @throws \Techworker\PascalCoin\RPC\ErrorException
     */
    public function publicKey(PublicKeyInterface $publicKey): PublicKey;

    /**
     * @throws \Techworker\PascalCoin\RPC\ConnectionException
     * @throws \Techworker\PascalCoin\RPC\ErrorException
     */
    public function balance(PublicKeyInterface $publicKey) : PascalCoin;
}
