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
}
