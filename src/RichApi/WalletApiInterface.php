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
 * Interface WalletApiInterface
 */
interface WalletApiInterface
{
    /**
     * Gets the list of accounts in the nodes wallet.
     *
     * @throws \Techworker\PascalCoin\RPC\ConnectionException
     * @throws \Techworker\PascalCoin\RPC\ErrorException
     */
    public function accounts(PublicKeyInterface $publicKey,
                             int $start = 0,
                             int $max = 100): array;

    /**
     * Gets the number of accounts in the nodes wallet.
     *
     * @throws \Techworker\PascalCoin\RPC\ConnectionException
     * @throws \Techworker\PascalCoin\RPC\ErrorException
     */
    public function countAccounts(PublicKeyInterface $publicKey,
                                 int $start = 0,
                                 int $max = 100): int;

    /**
     * Gets the list of public keys in the nodes wallet.
     *
     * @throws \Techworker\PascalCoin\RPC\ConnectionException
     * @throws \Techworker\PascalCoin\RPC\ErrorException
     *
     * @return PublicKey[]
     */
    public function publicKeys(int $start = 0,
                               int $max = 100): array;

    /**
     * Gets the public key in the wallet.
     *
     * @throws \Techworker\PascalCoin\RPC\ConnectionException
     * @throws \Techworker\PascalCoin\RPC\ErrorException
     *
     * @return PublicKey
     */
    public function publicKey(PublicKeyInterface $publicKey): PublicKey;

    /**
     * Gets the balance of the wallet.
     *
     * @throws \Techworker\PascalCoin\RPC\ConnectionException
     * @throws \Techworker\PascalCoin\RPC\ErrorException
     *
     * @return PascalCoin
     */
    public function balance(PublicKeyInterface $publicKey) : PascalCoin;
}
