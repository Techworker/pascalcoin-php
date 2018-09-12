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

namespace Techworker\PascalCoin\Type;

/**
 * Class Connection.
 *
 * Holds the information about a node connection.
 */
class Connection
{
    /**
     * True if this connection is to a server node. False if this connection
     * is a client node.
     *
     * @var bool
     */
    protected $server;

    /**
     * IP of the server.
     *
     * @var string
     */
    protected $ip;

    /**
     * Port of the server.
     *
     * @var int
     */
    protected $port;

    /**
     * Number of seconds the connection is alive.
     *
     * @var int
     */
    protected $secs;

    /**
     * The number of sent bytes.
     *
     * @var int
     */
    protected $sent;

    /**
     * The number of received bytes.
     *
     * @var int
     */
    protected $recv;

    /**
     * The application version of the other node.
     *
     * @var string
     */
    protected $appVer;

    /**
     * The protocol version of the other node.
     *
     * @var int
     */
    protected $netVar;

    /**
     * The available protocol version of the other node.
     *
     * @var int
     */
    protected $netVarA;

    /**
     * Time difference in seconds of the other node.
     *
     * @var int
     */
    protected $timeDiff;

    /**
     * The raw array, given with the constructor.
     *
     * @var array
     */
    protected $raw;

    /**
     * Creates a new instance of the Connection class.
     *
     * @param array $connection
     */
    public function __construct(array $connection)
    {
        $this->raw = $connection;

        $this->server = (bool) $connection['server'];
        $this->ip = (string) $connection['ip'];
        $this->port = (int) $connection['port'];
        $this->secs = (int) $connection['secs'];
        $this->sent = (int) $connection['sent'];
        $this->recv = (int) $connection['recv'];
        $this->appVer = (string) $connection['appver'];
        $this->netVar = (int) $connection['netver'];
        $this->netVarA = (int) $connection['netver_a'];
        $this->timeDiff = (int) $connection['timediff'];
    }

    /**
     * Gets True if this connection is to a server node. False if this
     * connection is a client node.
     *
     * @return bool
     */
    public function isServer(): bool
    {
        return $this->server;
    }

    /**
     * Gets the IP of the node.
     *
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * Gets the port of the node.
     *
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * Gets the number of seconds the connection to the node is alive.
     *
     * @return int
     */
    public function getSecs(): int
    {
        return $this->secs;
    }

    /**
     * Gets the sent bytes.
     *
     * @return int
     */
    public function getSent(): int
    {
        return $this->sent;
    }

    /**
     * Gets the received bytes.
     *
     * @return int
     */
    public function getRecv(): int
    {
        return $this->recv;
    }

    /**
     * Gets the app version of the node.
     *
     * @return string
     */
    public function getAppVer(): string
    {
        return $this->appVer;
    }

    /**
     * Gets the net protocol of the node.
     *
     * @return int
     */
    public function getNetVar(): int
    {
        return $this->netVar;
    }

    /**
     * Gets the available net protocol of the node.
     *
     * @return int
     */
    public function getNetVarA(): int
    {
        return $this->netVarA;
    }

    /**
     * Gets the time difference of the node.
     *
     * @return int
     */
    public function getTimeDiff(): int
    {
        return $this->timeDiff;
    }
}
