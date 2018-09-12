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
use Techworker\PascalCoin\Type\Simple\PascalCurrency;

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
     * @var PascalCurrency
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
        $this->amount = new PascalCurrency($receiver['amount']);
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
     * @return PascalCurrency
     */
    public function getAmount(): PascalCurrency
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
