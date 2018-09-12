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

use Techworker\PascalCoin\Type\Connection;

/**
 * Class NodeApi
 */
class NodeApi extends AbstractRichApi implements NodeApiInterface
{
    /**
     * @inheritdoc
     */
    public function addNodes(string ...$nodes): int
    {
        $this->rawApi->addNode($nodes);
    }

    /**
     * @inheritdoc
     */
    public function start(): bool
    {
        return $this->rawApi->startNode();
    }

    /**
     * @inheritdoc
     */
    public function stop(): bool
    {
        return $this->rawApi->stopNode();
    }

    /**
     * @inheritdoc
     */
    public function restart(): bool
    {
        return count(array_filter([
            $this->stop(),
            $this->start()
        ])) === 2;
    }

    /**
     * @inheritdoc
     */
    public function connections(): array
    {
        return array_map(function (array $connection) {
            return new Connection($connection);
        }, $this->rawApi->getConnections());
    }
}
