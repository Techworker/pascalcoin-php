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

use Techworker\CryptoCurrency\Currencies\PascalCoin as PascalCoinCurrency;
use Techworker\PascalCoin\Type\Simple\AccountNumber;
use Techworker\PascalCoin\Type\Simple\BlockNumber;
use Techworker\PascalCoin\Type\Simple\EncodedPublicKey;
use Techworker\PascalCoin\Type\Simple\HexaString;

/**
 * Class Block.
 *
 * Holds information about a block.
 */
class Block extends BlockNumber
{
    /**
     * Encoded public key value used to init 5 created accounts of this block.
     *
     * @var EncodedPublicKey
     */
    protected $encPubKey;

    /**
     * Reward paid to the first account created with the block.
     *
     * @var PascalCoinCurrency
     */
    protected $reward;

    /**
     * Accumulated fee of all operations.
     *
     * @var PascalCoinCurrency
     */
    protected $fee;

    /**
     * Pascal Coin protocol used.
     *
     * @var int
     */
    protected $ver;

    /**
     * Pascal Coin protocol available by the miner.
     *
     * @var int
     */
    protected $verA;

    /**
     * Unix timestamp of the block.
     *
     * @var int
     */
    protected $timestamp;

    /**
     * Target used.
     *
     * @var int
     */
    protected $target;

    /**
     * Nonce used.
     *
     * @var int
     */
    protected $nonce;

    /**
     * The payload of the miner.
     *
     * @var string
     */
    protected $payload;

    /**
     * The SafeBox Hash.
     *
     * @var HexaString
     */
    protected $sbh;

    /**
     * The operations hash.
     *
     * @var HexaString
     */
    protected $opHash;

    /**
     * Proof of work.
     *
     * @var HexaString
     */
    protected $pow;

    /**
     * Number of operations included in this block.
     *
     * @var int
     */
    protected $numberOfOperations;

    /**
     * Estimated network hashrate calculated by previous 50 blocks average.
     *
     * @var int
     */
    protected $hashRateKhs;

    /**
     * Number of blocks in the blockchain higher than this.
     *
     * @var int
     */
    protected $maturation;

    /**
     * @var AccountNumber[]
     */
    protected $accounts;

    /**
     * The raw array, given with the constructor.
     *
     * @var array
     */
    protected $raw;

    /**
     * Creates a new instance of the Block class.
     *
     * @param array $block
     */
    public function __construct(array $block)
    {
        $this->raw = $block;

        parent::__construct((int) $block['block']);

        $this->encPubKey = new EncodedPublicKey($block['enc_pubkey']);
        $this->reward = new PascalCoinCurrency((string) $block['reward']);
        $this->fee = new PascalCoinCurrency((string) $block['fee']);
        $this->ver = (int) $block['ver'];
        $this->verA = (int) $block['ver_a'];
        $this->timestamp = (int) $block['timestamp'];
        $this->target = $block['target'];
        $this->nonce = $block['nonce'];
        $this->payload = $block['payload'];
        $this->sbh = new HexaString($block['sbh']);
        $this->opHash = new HexaString($block['oph']);
        $this->pow = new HexaString($block['pow']);
        if (!isset($block['operations'])) {
            $this->numberOfOperations = 0;
        } else {
            $this->numberOfOperations = (int) $block['operations'];
        }
        $this->hashRateKhs = (int) $block['hashratekhs'];
        $this->maturation = (int) $block['maturation'];

        for ($i = 0; $i < 5; ++$i) {
            $this->accounts[] = new AccountNumber($this->block * 5 + $i);
        }
    }

    /**
     * Gets the block number.
     *
     * @return int
     */
    public function getBlock(): int
    {
        return $this->block;
    }

    /**
     * Gets the encoded public key.
     *
     * @return EncodedPublicKey
     */
    public function getEncPubKey(): EncodedPublicKey
    {
        return $this->encPubKey;
    }

    /**
     * Gets the reward paid to the first account.
     *
     * @return PascalCoinCurrency
     */
    public function getReward(): PascalCoinCurrency
    {
        return $this->reward;
    }

    /**
     * Gets the accumulated fee.
     *
     * @return PascalCoinCurrency
     */
    public function getFee(): PascalCoinCurrency
    {
        return $this->fee;
    }

    /**
     * Gets the Pascal Coin protocol used.
     *
     * @return int
     */
    public function getVer(): int
    {
        return $this->ver;
    }

    /**
     * Gets the Pascal Coin protocol available by the miner.
     *
     * @return int
     */
    public function getVerA(): int
    {
        return $this->verA;
    }

    /**
     * Gets the timestamp when the block was finished.
     *
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * Get the target.
     *
     * @return int
     */
    public function getTarget(): int
    {
        return $this->target;
    }

    /**
     * Get the nonce.
     *
     * @return int
     */
    public function getNonce(): int
    {
        return $this->nonce;
    }

    /**
     * Gets the payload of the miner.
     *
     * @return string
     */
    public function getPayload(): string
    {
        return $this->payload;
    }

    /**
     * Gets thew safebox hash.
     *
     * @return HexaString
     */
    public function getSbh(): HexaString
    {
        return $this->sbh;
    }

    /**
     * the the operation hash.
     *
     * @return HexaString
     */
    public function getOphash(): HexaString
    {
        return $this->opHash;
    }

    /**
     * Gets the proof of work hash.
     *
     * @return HexaString
     */
    public function getPow(): HexaString
    {
        return $this->pow;
    }

    /**
     * Gets the number of operations in the block.
     *
     * @return int
     */
    public function getNumberOfOperations(): int
    {
        return $this->numberOfOperations;
    }

    /**
     * Gets the hashrate in khz.
     *
     * @return int
     */
    public function getHashRateKhs(): int
    {
        return $this->hashRateKhs;
    }

    /**
     * Gets the age of the block (in blocks).
     *
     * @return int
     */
    public function getMaturation(): int
    {
        return $this->maturation;
    }

    /**
     * Gets the list of accounts generated by the block.
     *
     * @return AccountNumber[]
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }

    /**
     * Gets the the account that received the reward and the fees.
     *
     * @return AccountNumber
     */
    public function getRewardAccount(): AccountNumber
    {
        return $this->accounts[0];
    }

    /**
     * @return array
     */
    public function getRaw(): array
    {
        return $this->raw;
    }
}
