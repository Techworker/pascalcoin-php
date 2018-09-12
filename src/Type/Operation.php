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

use Techworker\PascalCoin\Type\Operation\Changer;
use Techworker\PascalCoin\Type\Operation\Receiver;
use Techworker\PascalCoin\Type\Operation\Sender;
use Techworker\PascalCoin\Type\Simple\AccountNumber;
use Techworker\PascalCoin\Type\Simple\BlockNumber;
use Techworker\PascalCoin\Type\Simple\OperationHash;
use Techworker\PascalCoin\Type\Simple\PascalCurrency;

/**
 * Class Operation.
 *
 * Holds data about an operation.
 */
class Operation extends OperationHash
{
    /**
     * A flag indicating whether the operation is valid.
     *
     * @var bool
     */
    protected $valid;

    /**
     * The errors if any.
     *
     * @var string
     */
    protected $errors;

    /**
     * The block number the operation is in.
     *
     * @var int
     */
    protected $block;

    /**
     * The time of the block.
     *
     * @var int
     */
    protected $time;

    /**
     * The position inside of the block.
     *
     * @var int
     */
    protected $opBlock;

    /**
     * The age of the block in blocks.
     *
     * @var int
     */
    protected $maturation;

    /**
     * The type of operation.
     *
     * @var int
     */
    protected $opType;

    /**
     * @var AccountNumber
     */
    protected $account;

    /**
     * @var string
     */
    protected $opTxt;

    /**
     * @var PascalCurrency
     */
    protected $amount;

    /**
     * @var PascalCurrency
     */
    protected $fee;

    /**
     * @var PascalCurrency
     */
    protected $balance;

    /**
     * @var string
     */
    protected $subType;

    /**
     * @var AccountNumber
     */
    protected $signerAccount;

    /**
     * @var Sender[]
     */
    protected $senders = [];

    /**
     * @var Receiver[]
     */
    protected $receivers = [];

    /**
     * @var Changer[]
     */
    protected $changers = [];

    /**
     * The raw array, given with the constructor.
     *
     * @var array
     */
    protected $raw;

    /**
     * Creates a new instance of the Operation class.
     *
     * @param array $operation
     */
    public function __construct(array $operation)
    {
        $this->raw = $operation;

        if (isset($operation['ophash'])) {
            parent::__construct($operation['ophash']);
        } else {
            parent::__construct('');
        }

        $this->valid = true;
        if (isset($operation['valid'])) {
            $this->valid = (bool) $operation['valid'];
        }

        $this->errors = $operation['errors'] ?? null;
        $this->block = new BlockNumber((int) $operation['block']);
        $this->time = (int) $operation['time'];
        $this->opBlock = (int) $operation['opblock'];
        $this->maturation = (int) $operation['maturation'];

        if (!\in_array($operation['optype'], self::OPTYPES, true)) {
            throw new \InvalidArgumentException('Invalid optype');
        }

        $this->opType = (int) $operation['optype'];

        if (self::OP_TYPE_MULTI !== $this->opType) {
            $this->account = new AccountNumber($operation['account']);
        }

        $this->opTxt = (string) $operation['optxt'];
        if ($this->opType === self::OP_TYPE_TRANSACTION) {
            $this->amount = new PascalCurrency((string) $operation['amount']);
        }

        $this->fee = new PascalCurrency((string) $operation['fee']);

        if (isset($operation['balance'])) {
            $this->balance = new PascalCurrency((string) $operation['balance']);
        }

        $this->subType = (string) $operation['subtype'];

        if (self::OP_TYPE_MULTI !== $this->opType) {
            $this->signerAccount = new AccountNumber($operation['signer_account']);
        }

        /** @var $operation array[] */
        foreach ($operation['senders'] as $sender) {
            $this->senders[] = new Sender($sender);
        }

        foreach ($operation['receivers'] as $receiver) {
            $this->receivers[] = new Receiver($receiver);
        }
        foreach ($operation['changers'] as $changer) {
            $this->changers[] = new Changer($changer);
        }
    }

    /**
     * Gets a value indicating whether the operation is valid.
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->valid;
    }

    /**
     * Gets a string describing an error.
     *
     * @return string
     */
    public function getErrors(): string
    {
        return $this->errors;
    }

    /**
     * Gets the block in which the operation occured.
     *
     * @return BlockNumber
     */
    public function getBlock(): BlockNumber
    {
        return $this->block;
    }

    /**
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * @return int
     */
    public function getOpBlock(): int
    {
        return $this->opBlock;
    }

    /**
     * Gets the age of the operation in blocks.
     *
     * @return int
     */
    public function getMaturation(): int
    {
        return $this->maturation;
    }

    /**
     * Gets the type of the operation.
     *
     * @return int
     */
    public function getOpType(): int
    {
        return $this->opType;
    }

    /**
     * Gets the account number.
     *
     * @return AccountNumber|null
     */
    public function getAccount(): ?AccountNumber
    {
        return $this->account;
    }

    /**
     * @return string
     */
    public function getOpTxt(): string
    {
        return $this->opTxt;
    }

    /**
     * @return PascalCurrency
     */
    public function getAmount(): PascalCurrency
    {
        return $this->amount;
    }

    /**
     * @return PascalCurrency
     */
    public function getFee(): PascalCurrency
    {
        return $this->fee;
    }

    /**
     * @return PascalCurrency
     */
    public function getBalance(): PascalCurrency
    {
        return $this->balance;
    }

    /**
     * @return OperationHash
     */
    public function getOpHash(): OperationHash
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getSubType(): string
    {
        return $this->subType;
    }

    /**
     * @return AccountNumber
     */
    public function getSignerAccount(): ?AccountNumber
    {
        return $this->signerAccount;
    }

    /**
     * @return Sender[]
     */
    public function getSenders(): array
    {
        return $this->senders;
    }

    /**
     * @return Receiver[]
     */
    public function getReceivers(): array
    {
        return $this->receivers;
    }

    /**
     * @return Changer[]
     */
    public function getChangers(): array
    {
        return $this->changers;
    }

    /**
     * @return array
     */
    public function getRaw(): array
    {
        return $this->raw;
    }

    public function mature()
    {
        $instance = clone $this;
        ++$instance->maturation;

        return $instance;
    }
}
