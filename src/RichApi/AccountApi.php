<?php

namespace Techworker\PascalCoin\RichApi;

use Techworker\PascalCoin\Type\Account;
use Techworker\PascalCoin\Type\Simple\AccountNumber;

class AccountApi extends AbstractRichApi implements AccountApiInterface
{
    public function find($account): ?Account
    {
        if(\is_int($account)) {
            $accountNumber = $account;
        } else if($account instanceof AccountNumber) {
            $accountNumber = $account->getAccount();
        } else if($account instanceof Account) {
            $accountNumber = $account->getAccount();
        } else {
            throw new \InvalidArgumentException('Invalid account given: ' . $account);
        }

        $data = $this->rawApi->getAccount($accountNumber);
        return new Account($data);
    }

}