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
class Status
{
    /**
     * The raw array, given with the constructor.
     *
     * @var array
     */
    protected $raw;

    /**
     * @var bool
     */
    protected $ready;

    /**
     * @var string
     */
    protected $readyText;

    /**
     * @var int
     */
    protected $port;

    /**
     * @var bool
     */
    protected $locked;

    /**
     * @var int
     */
    protected $timestamp;

    /**
     * @var string
     */
    protected $version;

    /**
     * @var int
     */
    protected $netProtocolVer;

    /**
     * @var int
     */
    protected $netProtocolVerA;

    /**
     * @var int
     */
    protected $blocks;

    /**
     * @var NetStats
     */
    protected $netStats;

    /**
     * @var Server[]
     */
    protected $servers = [];

    /**
     * @var HexaString
     */
    protected $sbh;

    /**
     * @var HexaString
     */
    protected $pow;

    /**
     * @var string
     */
    protected $openSslVersion;

    /**
     * Creates a new instance of the Block class.
     *
     * @param array $block
     */
    public function __construct(array $status)
    {
        $this->raw = $status;

        $this->ready = (bool)$status['ready'];
        $this->readyText = $status['ready_s'];
        $this->port = (int)$status['port'];
        $this->locked = (bool)$status['locked'];
        $this->timestamp = (int)$status['timestamp'];
        $this->version = (string)$status['version'];
        $this->netProtocolVer = (int)$status['netprotocol']['ver'];
        $this->netProtocolVerA = (int)$status['netprotocol']['ver_a'];
        $this->blocks = new BlockNumber($status['blocks']);
        $this->sbh = new HexaString($status['sbh']);
        $this->pow = new HexaString($status['pow']);
        $this->openSslVersion = (string)$status['openssl'];
        $this->blocks = (int)$status['blocks'];
        $this->netStats = new NetStats($status['netstats']);

        foreach($status['nodeservers'] as $nodeServer) {
            $this->servers[] = new Server($nodeServer);
        }
    }



    /**
     * @return array
     */
    public function getRaw(): array
    {
        return $this->raw;
    }
}
