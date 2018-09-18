<?php

namespace Techworker\PascalCoin\RichApi;

use Techworker\PascalCoin\Type\Account;
use Techworker\PascalCoin\Type\Simple\AccountNumber;

interface AccountApiInterface
{
    /**
     * Gets a single account identified by the account number.
     *
     * @param int|Account|AccountNumber $account
     * @throws \Techworker\PascalCoin\RPC\ConnectionException
     * @throws \Techworker\PascalCoin\RPC\ErrorException
     * @return null|Account
     */
    public function find($account) : ?Account;

    public function paged(int $limit, int $offset) : array;
}
