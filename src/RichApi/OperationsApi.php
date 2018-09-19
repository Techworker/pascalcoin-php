<?php

namespace Techworker\PascalCoin\RichApi;

use Techworker\PascalCoin\Type\Account;
use Techworker\PascalCoin\Type\Block;
use Techworker\PascalCoin\Type\Operation;
use Techworker\PascalCoin\Type\Simple\AccountNumber;
use Techworker\PascalCoin\Type\Simple\BlockNumber;

class OperationsApi extends AbstractRichApi implements OperationsApiInterface
{
    public function inBlock($block, int $offset, int $limit): array
    {
        $data = $this->rawApi->getBlockOperations($this->getBlockValue($block), $offset, $limit);
        return $this->arrayToInstanceArray($data, Operation::class);
    }
}
