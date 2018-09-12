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

/**
 * Class RichApi
 */
class RichApi implements RichApiInterface
{
    /**
     * The node api
     *
     * @var NodeApiInterface
     */
    protected $nodeApi;

    /**
     * The api with methods for the wallet.
     *
     * @var WalletApiInterface
     */
    protected $walletApi;

    /**
     * The api for account related functions.
     *
     * @var AccountApiInterface
     */
    protected $accountApi;

    /**
     * RichApi constructor.
     *
     * @param NodeApiInterface $nodeApi
     * @param WalletApiInterface $walletApi
     * @param AccountApiInterface $accountApi
     */
    public function __construct(NodeApiInterface $nodeApi,
                                WalletApiInterface $walletApi,
                                AccountApiInterface $accountApi
    )
    {
        $this->nodeApi = $nodeApi;
        $this->walletApi = $walletApi;
        $this->accountApi = $accountApi;
    }

    /**
     * Gets the current node instance with either the new endpoints or the given
     * endpoints.
     *
     * @return NodeApiInterface
     */
    public function node(): NodeApiInterface
    {
        return $this->nodeApi;
    }


    public function wallet(): WalletApiInterface
    {
        return $this->walletApi;
    }

    public function account(): AccountApiInterface
    {
        return $this->accountApi;
    }
}
