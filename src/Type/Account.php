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
use Techworker\PascalCoin\Type\Simple\AccountNumber;
use Techworker\PascalCoin\Type\Simple\EncodedPublicKey;
use Techworker\CryptoCurrency\Currencies\PascalCoin as PascalCoinCurrency;

/**
 * Class Account.
 *
 * Information about an account.
 */
class Account extends AccountNumber
{
    /**
     * The encoded public key.
     *
     * @var EncodedPublicKey
     */
    protected $encPubKey;

    /**
     * The balance of the account.
     *
     * @var PascalCoinCurrency
     */
    protected $balance;

    /**
     * The number of operations of the account.
     *
     * @var int
     */
    protected $nOperation;

    /**
     * The block number where the account was last updated.
     *
     * @var int
     */
    protected $updatedB;

    /**
     * The state of the account (either listed or normal).
     *
     * @var string
     */
    protected $state;

    /**
     * The block number until the account is blocked.
     *
     * @var int
     */
    protected $lockedUntilBlock;

    /**
     * The price of the account in case its listed.
     *
     * @var PascalCoinCurrency
     */
    protected $price;

    /**
     * The account number of the seller.
     *
     * @var AccountNumber
     */
    protected $sellerAccount;

    /**
     * A flag indicating whether the account is for sale in private.
     *
     * @var bool
     */
    protected $privateSale;

    /**
     * Private buyers public key. Only set if state is listed and private_sale
     * is true.
     *
     * @var EncodedPublicKey|null
     */
    protected $newEncPubKey;

    /**
     * Public name of account. Follows PascalCoin64 Encoding.
     *
     * @var string
     */
    protected $name;

    /**
     * The type of the account.
     *
     * @var int
     */
    protected $type;

    /**
     * The raw array, given with the constructor.
     *
     * @var array
     */
    protected $raw;

    /**
     * Creates a new instance of the Account class.
     *
     * @param array $account
     */
    public function __construct(array $account)
    {
        parent::__construct($account['account']);

        $this->raw = $account;
        $this->encPubKey = new EncodedPublicKey($account['enc_pubkey']);
        $this->balance = new PascalCoinCurrency((string) $account['balance']);
        $this->nOperation = (int) $account['n_operation'];
        $this->updatedB = (int) $account['updated_b'];

        if (!\in_array($account['state'], PascalCoin::STATES, true)) {
            throw new \InvalidArgumentException('Invalid account state.');
        }
        $this->state = $account['state'];

        if (isset($account['locked_until_block'])) {
            $this->lockedUntilBlock = (int) $account['locked_until_block'];
        }

        $this->privateSale = false;
        if ($account['state'] === PascalCoin::STATE_LISTED) {
            $this->price = new PascalCoinCurrency($account['price'], PascalCoinCurrency::MOLINA);
            $this->sellerAccount = new AccountNumber($account['seller_account']);
            $this->privateSale = (bool) $account['private_sale'];
            if ($this->privateSale === true) {
                //print_r($account);
                //exit;
                //$this->newEncPubKey = new EncodedPublicKey($account['new_enc_pubkey']);
            }
        }

        $this->name = $account['name'];
        $this->type = $account['type'];
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
     * Gets the balance of the account.
     *
     * @return PascalCoinCurrency
     */
    public function getBalance(): PascalCoinCurrency
    {
        return $this->balance;
    }

    /**
     * Gets the number of operations created by the account.
     *
     * @return int
     */
    public function getNOperation(): int
    {
        return $this->nOperation;
    }

    /**
     * Gets the block when the account was last updated.
     *
     * @return int
     */
    public function getUpdatedB(): int
    {
        return $this->updatedB;
    }

    /**
     * Gets the state of an account.
     *
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * Gets a value indicating whether the account is listed.
     *
     * @return bool
     */
    public function isListed(): bool
    {
        return $this->state === PascalCoin::STATE_LISTED;
    }

    /**
     * Gets the block until the account is locked when private sale is true.
     *
     * @return int|null
     */
    public function getLockedUntilBlock(): ?int
    {
        return $this->lockedUntilBlock;
    }

    /**
     * Gets the price of the account in case it is listed.
     *
     * @return PascalCoinCurrency|null
     */
    public function getPrice(): ?PascalCoinCurrency
    {
        return $this->price;
    }

    /**
     * Gets the account number of the seller.
     *
     * @return AccountNumber|null
     */
    public function getSellerAccount(): ?AccountNumber
    {
        return $this->sellerAccount;
    }

    /**
     * Gets a value indicating whether the sale is a private sale.
     *
     * @return bool
     */
    public function isPrivateSale(): bool
    {
        return $this->privateSale;
    }

    /**
     * Gets the new encoded public key when its a private sale.
     *
     * @return EncodedPublicKey|null
     */
    public function getNewEncPubKey(): ?EncodedPublicKey
    {
        return $this->newEncPubKey;
    }

    /**
     * Gets the name of the account.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Gets the type of the account.
     *
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getRaw(): array
    {
        return $this->raw;
    }
}
