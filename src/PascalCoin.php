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

use Techworker\PascalCoin\RichApi\AccountApiInterface;
use Techworker\PascalCoin\RichApi\BlockApiInterface;
use Techworker\PascalCoin\RichApi\NodeApiInterface;
use Techworker\PascalCoin\RichApi\WalletApiInterface;

/**
 * Class PascalCoin.
 *
 * The base PascalCoin class.
 */
class PascalCoin
{
    /**
     * The available EC types.
     *
     * @var int
     */
    public const EC_SECP256K1 = 714;
    public const EC_SECP384R1 = 715;
    public const EC_SECP283K1 = 729;
    public const EC_SECP521R1 = 716;

    /**
     * All available EC types.
     *
     * @var int[]
     */
    public const ECS = [
        self::EC_SECP256K1,
        self::EC_SECP384R1,
        self::EC_SECP283K1,
        self::EC_SECP521R1,
    ];

    /**
     * Available payload encryption methods.
     *
     * @var string
     */
    public const PAYLOAD_ENC_NONE = 'none';
    public const PAYLOAD_ENC_DEST = 'dest';
    public const PAYLOAD_ENC_SENDER = 'sender';
    public const PAYLOAD_ENC_AES = 'aes';

    /**
     * All available payload encryption methods.
     *
     * @var string[]
     */
    public const PAYLOAD_ENCS = [
        self::PAYLOAD_ENC_NONE,
        self::PAYLOAD_ENC_DEST,
        self::PAYLOAD_ENC_SENDER,
        self::PAYLOAD_ENC_AES,
    ];

    /**
     * The account states.
     */
    public const STATE_LISTED = 'listed';
    public const STATE_NORMAL = 'normal';

    /**
     * All possible account states.
     */
    public const STATES = [
        self::STATE_LISTED,
        self::STATE_NORMAL,
    ];

    /**
     * The available operation types.
     *
     * @var int
     */
    public const OP_TYPE_REWARD = 0;
    public const OP_TYPE_TRANSACTION = 1;
    public const OP_TYPE_CHANGE_KEY = 2;
    public const OP_TYPE_RECOVER_FUNDS = 3;
    public const OP_TYPE_LIST = 4;
    public const OP_TYPE_DELIST = 5;
    public const OP_TYPE_BUY = 6;
    public const OP_TYPE_CHANGE_KEY_SIGNED = 7;
    public const OP_TYPE_CHANGE_INFO = 8;
    public const OP_TYPE_MULTI = 9;

    /**
     * A list of all available operation types.
     *
     * @var int[]
     */
    public const OP_TYPES = [
        self::OP_TYPE_REWARD,
        self::OP_TYPE_TRANSACTION,
        self::OP_TYPE_CHANGE_KEY,
        self::OP_TYPE_RECOVER_FUNDS,
        self::OP_TYPE_LIST,
        self::OP_TYPE_DELIST,
        self::OP_TYPE_BUY,
        self::OP_TYPE_CHANGE_KEY_SIGNED,
        self::OP_TYPE_CHANGE_INFO,
        self::OP_TYPE_MULTI,
    ];

    /**
     * Raw api instance.
     *
     * @var RawApiInterface
     */
    private $rawApi;

    /**
     * The node api
     *
     * @var NodeApiInterface
     */
    protected $nodeApi;

    /**
     * The api with methods for the wallet.
     *
     * @var WalletApiInterface
     */
    protected $walletApi;

    /**
     * The api for account related functions.
     *
     * @var AccountApiInterface
     */
    protected $accountApi;

    /**
     * The api for block related methods.
     *
     * @var BlockApiInterface
     */
    protected $blockApi;

    /**
     * PascalCoin constructor.
     * @param RawApiInterface $rawApi
     * @param NodeApiInterface $nodeApi
     * @param WalletApiInterface $walletApi
     * @param AccountApiInterface $accountApi
     * @param BlockApiInterface $blockApi
     */
    public function __construct(RawApiInterface $rawApi,
                                NodeApiInterface $nodeApi,
                                WalletApiInterface $walletApi,
                                AccountApiInterface $accountApi,
                                BlockApiInterface $blockApi)
    {
        $this->rawApi = $rawApi;
        $this->nodeApi = $nodeApi;
        $this->walletApi = $walletApi;
        $this->accountApi = $accountApi;
        $this->blockApi = $blockApi;
    }

    /**
     * Gets the raw API implementation.
     *
     * @return RawApiInterface
     */
    public function raw(): RawApiInterface
    {
        return $this->rawApi;
    }

    /**
     * @return NodeApiInterface
     */
    public function node(): NodeApiInterface
    {
        return $this->nodeApi;
    }

    /**
     * @return WalletApiInterface
     */
    public function wallet(): WalletApiInterface
    {
        return $this->walletApi;
    }

    /**
     * @return AccountApiInterface
     */
    public function accounts(): AccountApiInterface
    {
        return $this->accountApi;
    }

    /**
     * @return BlockApiInterface
     */
    public function blocks(): BlockApiInterface
    {
        return $this->blockApi;
    }
}
