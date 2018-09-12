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

/**
 * Interface NodeApiInterface.
 */
interface NodeApiInterface
{
    /**
     * Adds one or more nodes to connect.
     *
     * @param string ...$nodes
     *
     * @throws \Techworker\PascalCoin\RPC\ConnectionException
     * @throws \Techworker\PascalCoin\RPC\ErrorException
     *
     * @return int
     */
    public function addNodes(string ...$nodes): int;

    /**
     * Starts the connections.
     *
     * @throws \Techworker\PascalCoin\RPC\ConnectionException
     * @throws \Techworker\PascalCoin\RPC\ErrorException
     * @return bool
     */
    public function start(): bool;

    /**
     * Stops establishing connections.
     *
     * @throws \Techworker\PascalCoin\RPC\ConnectionException
     * @throws \Techworker\PascalCoin\RPC\ErrorException
     * @return bool
     */
    public function stop(): bool;

    /**
     * Restarts connections.
     *
     * @throws \Techworker\PascalCoin\RPC\ConnectionException
     * @throws \Techworker\PascalCoin\RPC\ErrorException
     * @return bool
     */
    public function restart(): bool;

    /**
     * gets a list of connections.
     *
     * @throws \Techworker\PascalCoin\RPC\ConnectionException
     * @throws \Techworker\PascalCoin\RPC\ErrorException
     * @return array
     */
    public function connections(): array;
}
