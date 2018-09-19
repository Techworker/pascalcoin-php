<?php

namespace Techworker\PascalCoin\RichApi;

use Techworker\PascalCoin\Type\Account;
use Techworker\PascalCoin\Type\Block;
use Techworker\PascalCoin\Type\Operation;
use Techworker\PascalCoin\Type\Simple\AccountNumber;
use Techworker\PascalCoin\Type\Simple\BlockNumber;

interface OperationsApiInterface
{
    /**
     * Gets the operations of the given block.
     *
     * @param int|BlockNumber|Block $block
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function inBlock($block, int $offset, int $limit) : array;
}
