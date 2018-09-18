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

namespace Techworker\PascalCoin\RichApi;

use Techworker\PascalCoin\Type\Block;
use Techworker\PascalCoin\Type\Status;

/**
 * Interface NodeApiInterface.
 */
interface BlockApiInterface
{
    public function listLast(int $amount) : array;
    public function count() : int;
    public function at($block) : ?Block;
    public function allOperations($block, int $perPage = 100) : array;
    public function paged(int $limit, int $offset) : array;
}
