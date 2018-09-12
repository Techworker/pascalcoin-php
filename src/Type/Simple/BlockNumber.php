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

namespace Techworker\PascalCoin\Type\Simple;

use Techworker\PascalCoin\Type\RpcValueInterface;

/**
 * Class BlockNumber.
 *
 * This type holds the id of a block.
 */
class BlockNumber implements RpcValueInterface
{
    /**
     * The block number.
     *
     * @var int
     */
    protected $block;

    /**
     * BlockNumber constructor.
     *
     * @param int $block
     */
    public function __construct(int $block)
    {
        $this->block = $block;
    }

    /**
     * Gets the block number.
     *
     * @return int
     */
    public function getValue(): int
    {
        return $this->block;
    }
}
