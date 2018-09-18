<?php

namespace Techworker\PascalCoin\RichApi;

use Techworker\PascalCoin\Type\Account;
use Techworker\PascalCoin\Type\Block;
use Techworker\PascalCoin\Type\Operation;
use Techworker\PascalCoin\Type\Simple\AccountNumber;

class BlockApi extends AbstractRichApi implements BlockApiInterface
{
    public function listLast(int $amount): array
    {
        $data = $this->rawApi->getBlocks($amount);
        return $this->arrayToInstanceArray($data, Block::class);
    }

    public function count(): int
    {
        return $this->rawApi->getBlockCount();
    }

    public function at($block) : ?Block
    {
        return new Block($this->rawApi->getBlock(
            $this->getBlockValue($block)
        ));
    }

    /**
     * @param $block
     * @param int $perPage
     * @return Operation[]
     * @throws \Techworker\PascalCoin\RPC\ConnectionException
     * @throws \Techworker\PascalCoin\RPC\ErrorException
     */
    public function allOperations($block, int $perPage = 100) : array
    {
        $params = [];
        $params['block'] = $this->getBlockValue($block);
        $params['start'] = 0;
        $params['max'] = $perPage;

        $all = [];
        do {
            $operations = $this->rawApi->getBlockOperations($params['block'], $params['start'], $params['max']);
            $params['start'] += $perPage;
            $all = array_merge($operations, $all);
        } while(count($operations) > 0 && count($operations) === $perPage);

        return $this->arrayToInstanceArray($operations, Operation::class);
    }

    public function paged(int $limit, int $offset): array
    {
        $data = $this->rawApi->getBlocks(null, $limit, $offset);
        return $this->arrayToInstanceArray($data, Block::class);
    }
}
