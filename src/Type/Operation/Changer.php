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

namespace Techworker\PascalCoin\Type\Operation;

use Techworker\PascalCoin\Type\Simple\AccountNumber;
use Techworker\PascalCoin\Type\Simple\HexaString;
use Techworker\PascalCoin\Type\Simple\PascalCurrency;

/**
 * Class Sender.
 */
class Changer
{
    /**
     * The account that is changed.
     *
     * @var AccountNumber
     */
    protected $account;

    /**
     * The number of operations of the account.
     *
     * @var int
     */
    protected $nOperation;

    /**
     * The new public key.
     *
     * @var HexaString
     */
    protected $newEncPubKey;

    /**
     * The new name of the account.
     *
     * @var string
     */
    protected $newName;

    /**
     * The new type of the account.
     *
     * @var int
     */
    protected $newType;

    /**
     * The account that sells the account.
     *
     * @var AccountNumber
     */
    protected $sellerAccount;

    /**
     * The price of the account.
     *
     * @var PascalCurrency
     */
    protected $accountPrice;

    /**
     * block until the account is locked (listed + private).
     *
     * @var int
     */
    protected $lockedUntilBlock;

    /**
     * The fee.
     *
     * @var PascalCurrency
     */
    protected $fee;

    /**
     * The raw array, given with the constructor.
     *
     * @var array
     */
    protected $raw;

    /**
     * Creates a new instance of the Changer class.
     *
     * @param array $changer
     */
    public function __construct(array $changer)
    {
        $this->raw = $changer;
        $this->account = new AccountNumber($changer['account']);

        $this->nOperation = 0;
        if (isset($changer['n_operation'])) {
            $this->nOperation = (int) $changer['n_operation'];
        }

        if (isset($changer['new_enc_pubkey'])) {
            $this->newEncPubKey = new HexaString($changer['new_enc_pubkey']);
        }
        if (isset($changer['new_name'])) {
            $this->newName = $changer['new_name'];
        }

        if (isset($changer['new_type'])) {
            $this->newType = $changer['new_type'];
        }

        if (isset($changer['seller_account'])) {
            $this->sellerAccount = new AccountNumber($changer['seller_account']);
        }

        if (isset($changer['account_price'])) {
            $this->accountPrice = new PascalCurrency($changer['account_price']);
        }

        if (isset($changer['locked_until_block'])) {
            $this->lockedUntilBlock = (int) $changer['locked_until_block'];
        }

        if (isset($changer['fee'])) {
            $this->fee = new PascalCurrency($changer['fee']);
        }
    }

    /**
     * @return AccountNumber
     */
    public function getAccount(): AccountNumber
    {
        return $this->account;
    }

    /**
     * @return int
     */
    public function getNOperation(): int
    {
        return $this->nOperation;
    }

    /**
     * @return HexaString|null
     */
    public function getNewEncPubKey(): ?HexaString
    {
        return $this->newEncPubKey;
    }

    /**
     * @return string|null
     */
    public function getNewName(): ?string
    {
        return $this->newName;
    }

    /**
     * @return int|null
     */
    public function getNewType(): ?int
    {
        return $this->newType;
    }

    /**
     * @return AccountNumber|null
     */
    public function getSellerAccount(): ?AccountNumber
    {
        return $this->sellerAccount;
    }

    /**
     * @return PascalCurrency
     */
    public function getAccountPrice(): PascalCurrency
    {
        return $this->accountPrice;
    }

    /**
     * @return int|null
     */
    public function getLockedUntilBlock(): ?int
    {
        return $this->lockedUntilBlock;
    }

    /**
     * @return PascalCurrency
     */
    public function getFee(): ?PascalCurrency
    {
        return $this->fee;
    }
}
