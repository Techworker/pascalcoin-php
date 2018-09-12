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

namespace Techworker\PascalCoin;

use Techworker\PascalCoin\RichApi\AccountApiInterface;
use Techworker\PascalCoin\RichApi\NodeApiInterface;
use Techworker\PascalCoin\RichApi\WalletApiInterface;

/**
 * Interface PascalCoinRPCInterface.
 *
 * An interface that describes the pascalcoin RPC.
 */
interface RichApiInterface
{
    public function node(): NodeApiInterface;
    public function account(): AccountApiInterface;
    public function wallet(): WalletApiInterface;
}
