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

use Techworker\CryptoCurrency\Currencies\PascalCoin as PascalCoinCurrency;
use Techworker\PascalCoin\Type\Simple\AccountNumber;

/**
 * Class Sender.
 */
class Sender
{
    /**
     * @var AccountNumber
     */
    protected $account;

    /**
     * @var int
     */
    protected $nOperation;

    /**
     * @var PascalCoinCurrency
     */
    protected $amount;

    /**
     * @var string
     */
    protected $payload;

    /**
     * The raw array, given with the constructor.
     *
     * @var array
     */
    protected $raw;

    /**
     * Creates a new instancce of the Sender class.
     *
     * @param array $sender
     */
    public function __construct(array $sender)
    {
        $this->raw = $sender;
        $this->account = new AccountNumber($sender['account']);
        $this->nOperation = (int) $sender['n_operation'];
        $this->amount = new PascalCoinCurrency($sender['amount']);
        $this->payload = (string) $sender['amount'];
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
     * @return PascalCoinCurrency
     */
    public function getAmount(): PascalCoinCurrency
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getPayload(): string
    {
        return $this->payload;
    }
}
