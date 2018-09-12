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

/**
 * Class Node.
 *
 * Representation of a simple node endpoint.
 */
class EndPoint
{
    const SCHEMA_HTTP = 'http';
    const SCHEMA_HTTPS = 'https';

    /**
     * The address of the node.
     *
     * @var string
     */
    protected $host;

    /**
     * The port of the node.
     *
     * @var int
     */
    protected $port;

    /**
     * The schema to access the node.
     *
     * @var string
     */
    protected $schema;

    /**
     * Node constructor.
     *
     * @param string $host
     * @param int $port
     * @param string $schema
     */
    public function __construct(string $host, int $port = 4003, $schema = 'http')
    {
        $this->host = $host;
        $this->port = $port;
        $this->schema = $schema;

        if (filter_var((string) $this, FILTER_VALIDATE_URL) === false) {
            throw new \InvalidArgumentException('Invalid node scheme+host+port');
        }
    }

    /**
     * Gets the comple node url-.
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s://%s:%d', $this->schema, $this->host, $this->port);
    }
}
