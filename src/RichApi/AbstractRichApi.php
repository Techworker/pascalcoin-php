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

use App\Block;
use Techworker\PascalCoin\RawApiInterface;
use Techworker\PascalCoin\Type\Account;
use Techworker\PascalCoin\Type\PublicKey;
use Techworker\PascalCoin\Type\Simple\AccountNumber;
use Techworker\PascalCoin\Type\Simple\BlockNumber;
use Techworker\PascalCoin\Type\Simple\EncodedPublicKey;
use Techworker\PascalCoin\Type\Simple\PublicKeyInterface;

/**
 * Class AbstractRichApi
 *
 * Basic implementation for a rich api.
 */
abstract class AbstractRichApi
{
    /**
     * The raw api.
     *
     * @var RawApiInterface
     */
    protected $rawApi;

    /**
     * NodeApi constructor.
     *
     * @param RawApiInterface $rawApi
     */
    public function __construct(RawApiInterface $rawApi)
    {
        $this->rawApi = $rawApi;
    }

    /**
     * @param PublicKeyInterface $publicKey
     * @param string $requiredClass
     * @return null
     */
    protected function getPublicKeyValue(PublicKeyInterface $publicKey, string $requiredClass) : ?string
    {
        if($publicKey instanceof $requiredClass) {
            return $publicKey->getValue();
        }

        if($publicKey instanceof PublicKey && $requiredClass === EncodedPublicKey::class) {
            return $publicKey->getValue();
        }

        return null;
    }

    /**
     * Extracts the account number from the given parameter.
     *
     * @param int|Account|AccountNumber $account
     * @throws \InvalidArgumentException
     * @return int
     */
    protected function getAccountValue($account) {

        if(\is_int($account)) {
            $accountNumber = $account;
        } else if($account instanceof AccountNumber) {
            $accountNumber = $account->getValue();
        } else if($account instanceof Account) {
            $accountNumber = $account->getValue();
        } else {
            throw new \InvalidArgumentException('Invalid account given: ' . $account);
        }

        return $accountNumber;
    }

    /**
     * Extracts the block number from the given parameter.
     *
     * @param int|Block|BlockNumber $block
     * @throws \InvalidArgumentException
     * @return int
     */
    protected function getBlockValue($block) : int {

        if(\is_int($block)) {
            $blockNumber = $block;
        } else if($block instanceof BlockNumber) {
            $blockNumber = $block->getValue();
        } else if($block instanceof \Techworker\PascalCoin\Type\Block) {
            $blockNumber = $block->getValue();
        } else {
            throw new \InvalidArgumentException('Invalid block given: ' . $block);
        }

        return $blockNumber;
    }

    protected function arrayToInstanceArray(array $data, string $cls) {
        $result = [];
        foreach ($data as $datum) {
            $result[] = new $cls($datum);
        }

        return $result;
    }
}
