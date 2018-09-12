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
class NetStats
{
    /**
     * The raw array, given with the constructor.
     *
     * @var array
     */
    protected $raw;

    /**
     * @var int
     */
    protected $active;

    /**
     * @var int
     */
    protected $clients;

    /**
     * @var int
     */
    protected $activeServers;

    /**
     * @var int
     */
    protected $allServers;

    /**
     * @var int
     */
    protected $total;

    /**
     * @var int
     */
    protected $allClients;

    /**
     * @var int
     */
    protected $allServers2;

    /**
     * @var int
     */
    protected $bytesReceived;

    /**
     * @var int
     */
    protected $bytesSent;

    /**
     * Creates a new instance of the Block class.
     *
     * @param array $block
     */
    public function __construct(array $status)
    {
        $this->raw = $status;

        $this->active = (int)$status['active'];
        $this->clients = (int)$status['clients'];
        $this->activeServers = (int)$status['servers'];
        $this->allServers = (int)$status['servers_t'];
        $this->total = (int)$status['total'];
        $this->allClients = (int)$status['tclients'];
        $this->allServers2 = (int)$status['tservers'];
        $this->bytesReceived = (int)$status['breceived'];
        $this->bytesSent = (int)$status['bsend'];
    }

    /**
     * @return array
     */
    public function getRaw(): array
    {
        return $this->raw;
    }
}
