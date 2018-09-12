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

use Techworker\PascalCoin\AbstractRPCClient;
use Techworker\PascalCoin\EndPoint;

/**
 * Class Curl.
 *
 * Curl implementation of an JSON RPC 2.0 HTTP client.
 */
class Curl extends AbstractRPCClient
{
    /**
     * {@inheritdoc}
     */
    protected function request(array $rpc, EndPoint $endPoint)
    {
        try {
            $ch = curl_init((string) $endPoint);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($rpc));

            $result = curl_exec($ch);
            if ($result === false) {
                throw new ConnectionException('Unable to connect to '.$endPoint);
            }

            return $result;
        } catch (\Exception $ex) {
            print_r($ex);
        }
    }
}
