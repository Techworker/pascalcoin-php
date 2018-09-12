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

namespace Techworker\PascalCoin;

use Techworker\PascalCoin\RichApi\AccountApiInterface;
use Techworker\PascalCoin\RichApi\NodeApiInterface;
use Techworker\PascalCoin\RichApi\WalletApiInterface;

class RichApi implements RichApiInterface
{
    use HasEndpointsTrait;

    protected $nodeApi;
    protected $walletApi;
    protected $accountApi;

    public function __construct(NodeApiInterface $nodeApi, WalletApiInterface $walletApi, AccountApiInterface $accountApi)
    {
        $this->nodeApi = $nodeApi;
        $this->walletApi = $walletApi;
        $this->accountApi = $accountApi;
    }

    public function node(EndPoint ...$endPoints): NodeApiInterface
    {
        if (count($endPoints) === 0) {
            $endPoints = $this->endPoints;
        }

        return $this->nodeApi->setEndpoints(...$endPoints);
    }


    public function wallet(EndPoint ...$endPoints): WalletApiInterface
    {
        if (count($endPoints) === 0) {
            $endPoints = $this->endPoints;
        }

        return $this->walletApi->setEndpoints(...$endPoints);
    }

    public function account(EndPoint ...$endPoints): AccountApiInterface
    {
        if (count($endPoints) === 0) {
            $endPoints = $this->endPoints;
        }

        $this->accountApi->setEndpoints(...$endPoints);
        return $this->accountApi;
    }
}
