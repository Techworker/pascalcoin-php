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

use Techworker\PascalCoin\PascalCoin;
use Techworker\PascalCoin\Type\Simple\Base58PublicKey;
use Techworker\PascalCoin\Type\Simple\Base58PublicKeyInterface;
use Techworker\PascalCoin\Type\Simple\EncodedPublicKey;
use Techworker\PascalCoin\Type\Simple\HexaString;
use Techworker\PascalCoin\Type\Simple\PublicKeyInterface;

/**
 * Class PublicKey.
 *
 * Holds the information about a public key.
 */
class PublicKey implements PublicKeyInterface
{
    /**
     * Human readable name stored at the Wallet for this key.
     *
     * @var string
     */
    protected $name;

    /**
     * If false then the wallet doesn't have the private key for this public
     * key, so the node cannot execute operations with this key.
     *
     * @var bool
     */
    protected $canUse;

    /**
     * Encoded value of this public key in Base 58 format, also contains a
     * checksum. This is the same value that Application Wallet exports as
     * a public key.
     *
     * @var Base58PublicKeyInterface
     */
    protected $b58PubKey;

    /**
     * Encoded value of this public key in Base 58 format, also contains a
     * checksum. This is the same value that Application Wallet exports as
     * a public key.
     *
     * @var
     */
    protected $encPubKey;

    /**
     * Indicates which EC type is used. See EC_* constants.
     *
     * @var int
     */
    protected $ecNid;

    /**
     * X value of public key.
     *
     * @var HexaString
     */
    protected $x;

    /**
     * Y value of public key.
     *
     * @var HexaString
     */
    protected $y;

    /**
     * The raw array, given with the constructor.
     *
     * @var array
     */
    protected $raw;

    /**
     * Creates a new instance of the PublicKey class.
     *
     * @param array $publicKey
     */
    public function __construct(array $publicKey)
    {
        $this->raw = $publicKey;

        $this->name = $publicKey['name'] ?? null;
        $this->canUse = $publicKey['can_use'] ?? false;

        $this->b58PubKey = new Base58PublicKey($publicKey['b58_pubkey']);
        $this->encPubKey = new EncodedPublicKey($publicKey['enc_pubkey']);

        if (!\in_array($publicKey['ec_nid'], PascalCoin::ECS, true)) {
            throw new \InvalidArgumentException('Invalid value for ec_nid');
        }

        $this->ecNid = (int) $publicKey['ec_nid'];
        $this->x = new HexaString($publicKey['x']);
        $this->y = new HexaString($publicKey['y']);
    }

    /**
     * Gets the human readable name stored at the Wallet for this key.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Gets a value indicating whether the node knows the private key.
     *
     * @return bool
     */
    public function isCanUse(): bool
    {
        return $this->canUse;
    }

    /**
     * Gets the encoded public key without a checksum.
     *
     * @return EncodedPublicKey
     */
    public function getEncPubKey(): EncodedPublicKey
    {
        return $this->encPubKey;
    }

    /**
     * Gets the public key in base58 format.
     *
     * @return Base58PublicKeyInterface
     */
    public function getB58PubKey(): Base58PublicKeyInterface
    {
        return $this->b58PubKey;
    }

    /**
     * Gets the ec type.
     *
     * @return int
     */
    public function getEcNid(): int
    {
        return $this->ecNid;
    }

    /**
     * Gets the X value of the public key.
     *
     * @return HexaString
     */
    public function getX(): HexaString
    {
        return $this->x;
    }

    /**
     * Gets the Y value of the public key.
     *
     * @return HexaString
     */
    public function getY(): HexaString
    {
        return $this->y;
    }

    public function getValue()
    {
        return $this->getEncPubKey()->__toString();
    }


}
