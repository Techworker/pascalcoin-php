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

namespace Techworker\PascalCoin\Tests\RPC;

use Techworker\PascalCoin\AbstractRPCClient;
use Techworker\PascalCoin\EndPoint;

/**
 * Class Curl.
 *
 * Curl implementation of an JSON RPC 2.0 HTTP client.
 */
class FixtureRpcClient extends AbstractRPCClient
{
    /**
     * {@inheritdoc}
     */
    protected function request(array $rpc, EndPoint $endPoint)
    {

    }
}
