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

use Techworker\PascalCoin\RPC\ErrorException;

/**
 * Abstract class for RPC implementations (guzzle, curl, ..).
 */
abstract class AbstractRPCClient
{
    /**
     * The call counter.
     *
     * @var int
     */
    private static $id = 1;

    /**
     * Converts the given params to a JSON RPC specific request structure.
     *
     * @param string $method
     * @param array $params
     * @param int $id
     *
     * @return array
     */
    protected function toRpc(string $method, array $params, int $id = -1): array
    {
        return [
            'id' => $id > -1 ? $id : self::$id++,
            'jsonrpc' => '2.0',
            'method' => $method,
            'params' => $params,
        ];
    }

    /**
     * Parsed the response and returns either the result or throws an exception.
     *
     * @param string $response
     *
     * @throws ErrorException
     *
     * @return mixed
     */
    public function parseResponse(string $response)
    {
        $data = json_decode($response, true);
        if (isset($data['error'])) {
            throw new ErrorException($data['message'], $data['code']);
        }

        return $data['result'];
    }

    /**
     * Sends a request to the given endpoint.
     *
     * @param string $method
     * @param array $params
     * @param EndPoint $endPoint
     * @param int $id
     *
     * @throws ErrorException
     *
     * @return mixed
     */
    public function send(string $method, array $params, EndPoint $endPoint, int $id = -1)
    {
        // convert the data
        $rpc = $this->toRpc($method, $params, $id);
        // execute request with implemented code
        $response = $this->request($rpc, $endPoint);

        return $this->parseResponse($response);
    }

    /**
     * Sends a single request.
     *
     * @param string $method
     * @param array $params
     * @param int $id
     *
     * @return mixed
     */
    abstract protected function request(array $rpc, EndPoint $endPoint);
}
