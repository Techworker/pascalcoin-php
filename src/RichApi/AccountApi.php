<?php

namespace Techworker\PascalCoin\RichApi;

use Techworker\PascalCoin\Type\Account;
use Techworker\PascalCoin\Type\Simple\AccountNumber;

class AccountApi extends AbstractRichApi implements AccountApiInterface
{
    public function find($account): ?Account
    {
        $data = $this->rawApi->getAccount(
            $this->getAccountValue($account)
        );

        return new Account($data);
    }

    public function paged(int $limit, int $offset): array
    {
        $data = $this->rawApi->findAccounts(null, null, null, null, null, null, $offset, $limit);
        return $this->arrayToInstanceArray($data, Account::class);
    }
}
