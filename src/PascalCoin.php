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
     * Rich api instance.
     *
     * @var RichApiInterface
     */
    private $richApi;

    /**
     * The list of remote nodes.
     *
     * @var EndPoint[]
     */
    private $endPoints;

    /**
     * PascalCoin constructor.
     *
     * @param RawApi $rawApi
     * @param RichApi $richApi
     * @param array $endPoints
     */
    public function __construct(RawApi $rawApi, RichApi $richApi, array $endPoints = [])
    {
        $this->rawApi = $rawApi;
        $this->richApi = $richApi;
        $this->endPoints = $endPoints;
    }

    /**
     * Gets the raw API implementation for the given endpoints.
     *
     * @param EndPoint ...$endPoints
     *
     * @return RawApi
     */
    public function getRawApi(EndPoint ...$endPoints): RawApi
    {
        if (count($endPoints) === 0) {
            return $this->rawApi->setEndpoints(...$this->endPoints);
        }

        return $this->rawApi->setEndpoints(...$endPoints);
    }

    /**
     * Gets the rich API implementation.
     *
     * @param EndPoint ...$endPoints
     *
     * @return RichApi
     */
    public function getRichApi(EndPoint ...$endPoints): RichApi
    {
        if (count($endPoints) === 0) {
            return $this->richApi->setEndpoints(...$this->endPoints);
        }

        return $this->richApi->setEndpoints(...$endPoints);
    }
}
