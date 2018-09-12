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

namespace Techworker\PascalCoin\Type;

use Techworker\PascalCoin\Type\Simple\AccountNumber;
use Techworker\PascalCoin\Type\Simple\BlockNumber;
use Techworker\PascalCoin\Type\Simple\EncodedPublicKey;
use Techworker\PascalCoin\Type\Simple\HexaString;
use Techworker\PascalCoin\Type\Simple\PascalCurrency;

/**
 * Class Block.
 *
 * Holds information about a block.
 */
class Server
{
    /**
     * The raw array, given with the constructor.
     *
     * @var array
     */
    protected $raw;

    /**
     * @var string
     */
    protected $ip;

    /**
     * @var int
     */
    protected $port;

    /**
     * @var int
     */
    protected $lastConnection;

    /**
     * @var int
     */
    protected $attempts;

    /**
     * Creates a new instance of the Block class.
     *
     * @param array $server
     */
    public function __construct(array $server)
    {
        $this->raw = $server;

        $this->ip = (string)$server['ip'];
        $this->port = (int)$server['port'];
        $this->lastConnection = (int)$server['lastcon'];
        $this->attempts = (int)$server['attempts'];
    }



    /**
     * @return array
     */
    public function getRaw(): array
    {
        return $this->raw;
    }
}
