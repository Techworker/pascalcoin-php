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
class Receiver
{
    /**
     * @var AccountNumber
     */
    protected $account;

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
     * Creates a new instance of the Receiver class.
     *
     * @param array $receiver
     */
    public function __construct(array $receiver)
    {
        $this->raw = $receiver;
        $this->account = new AccountNumber($receiver['account']);
        $this->amount = new PascalCoinCurrency($receiver['amount']);
        $this->payload = (string) $receiver['amount'];
    }

    /**
     * @return AccountNumber
     */
    public function getAccount(): AccountNumber
    {
        return $this->account;
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
