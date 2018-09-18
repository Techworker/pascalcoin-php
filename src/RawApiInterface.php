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

use Techworker\PascalCoin\RPC\ConnectionException;
use Techworker\PascalCoin\RPC\ErrorException;

/**
 * Interface RawApiInterface.
 *
 * This interface describes the pascalcoin RPC API 1to1.
 */
interface RawApiInterface
{
    /**
     * Adds one or more nodes to connect to and returns the number of added
     * nodes.
     *
     * @param array $nodes List of nodes to add in the form of IP:PORT
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return int
     */
    public function addNode(array $nodes): int;

    /**
     * Gets the status of the node.
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function nodeStatus(): array;

    /**
     * Starts the server.
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return bool
     */
    public function startNode(): bool;

    /**
     * Stops the server.
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return bool
     */
    public function stopNode(): bool;

    /**
     * Gets a list of accounts in the nodes wallet.
     *
     * @param string|null $encPubKey
     * @param string|null $b58PubKey
     * @param int $start
     * @param int $max
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function getWalletAccounts(
        string $encPubKey = null,
        string $b58PubKey = null,
        int $start = 0,
        int $max = 100
    ): array;

    /**
     * Gets the number of accounts in the wallet.
     *
     * @param string|null $encPubKey
     * @param string|null $b58PubKey
     * @param int $start
     * @param int $max
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return int
     */
    public function getWalletAccountsCount(
        string $encPubKey = null,
        string $b58PubKey = null,
        int $start = 0,
        int $max = 100
    ): int;

    /**
     * Gets a list of public keys in the wallet.
     *
     * @param int $start
     * @param int $max
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function getWalletPubKeys(
        int $start = 0,
        int $max = 100
    ): array;

    /**
     * Gets a public key.
     *
     * @param string|null $encPubKey
     * @param string|null $b58PubKey
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function getWalletPubKey(
        string $encPubKey = null,
        string $b58PubKey = null
    ): array;

    /**
     * Gets the balance of the wallet.
     *
     * @param string|null $encPubKey
     * @param string|null $b58PubKey
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return mixed
     */
    public function getWalletCoins(
        string $encPubKey = null,
        string $b58PubKey = null
    );

    /**
     * Gets the information of the given block.
     *
     * @param int $block
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function getBlock(int $block): array;

    /**
     * Gets a list of blocks from "start" to "end" (or "last" n) in
     * DESCENDING order.
     *
     * @param int|null $last
     * @param int|null $start
     * @param int|null $end
     * @param int|null $max
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function getBlocks(
        ?int $last = 0,
        ?int $start = 0,
        ?int $end = 0,
        ?int $max = 0
    ): array;

    /**
     * Gets the number of blocks.
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return int
     */
    public function getBlockCount(): int;

    /**
     * Gets an operation inside of the given block identified by its position.
     *
     * @param int $block
     * @param int $opBlock
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function getBlockOperation(
        int $block,
        int $opBlock = 0
    ): array;

    /**
     * @param int $block
     * @param int $start
     * @param int $max
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function getBlockOperations(
        int $block,
        int $start = 0,
        int $max = 100
    ): array;

    /**
     * Returns information about an account (including the results of pending
     * operations).
     *
     * @param int $account
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function getAccount(int $account): array;

    /**
     * Gets a list of operations of the given account.
     *
     * @param int $account
     * @param int $depth
     * @param int $startBlock
     * @param int $start
     * @param int $max
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function getAccountOperations(
        int $account,
        int $depth = 100,
        int $startBlock = 0,
        int $start = 0,
        int $max = 100
    ): array;

    /**
     * Gets a list of pending operations.
     *
     * @param int $start
     * @param int $max
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function getPendings(
        int $start = 0,
        int $max = 100
    ): array;

    /**
     * Gets the number of pending operations.
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return int
     */
    public function getPendingsCount(): int;

    /**
     * Decodes the given op hash.
     *
     * @param string $opHash
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function decodeOpHash(
        string $opHash
    ): array;

    /**
     * Returns the operation with the given ophash.
     *
     * @param string $opHash
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function findOperation(
        string $opHash
    ): array;

    /**
     * @param int $account
     * @param int $block
     * @param int $nOperation
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function findNOperation(
        int $account,
        int $block = 0,
        int $nOperation = 0
    ): array;

    /**
     * @param int $account
     * @param int $startBlock
     * @param int $nOperationMin
     * @param int $nOperationMax
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function findNOperations(
        int $account,
        int $startBlock = 0,
        int $nOperationMin = 0,
        int $nOperationMax = 0
    ): array;

    /**
     * Returns a list of accounts matching the given parameters.
     *
     * @param string|null $name
     * @param int|null $type
     * @param bool $listed
     * @param bool $exact
     * @param string $minBalance
     * @param string $maxBalance
     * @param int $start
     * @param int $max
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function findAccounts(
        ?string $name,
        ?int $type,
        ?bool $listed,
        ?bool $exact,
        ?string $minBalance,
        ?string $maxBalance,
        ?int $start,
        ?int $max
    ): array;

    /**
     * Executes a transaction operation from "sender" to "target".
     *
     * @param int $sender
     * @param int $target
     * @param string $amount
     * @param string $fee
     * @param string $payload
     * @param string $payloadMethod
     * @param string $pwd
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function sendTo(
        int $sender,
        int $target,
        string $amount,
        string $fee = '0',
        string $payload = '',
        string $payloadMethod = PascalCoin::PAYLOAD_ENC_DEST,
        string $pwd = ''
    ): array;

    /**
     * @param null|string $rawOperations
     * @param int|null $protocol
     * @param null|string $senderEncPubKey
     * @param null|string $senderB58PubKey
     * @param null|string $targetEncPubKey
     * @param null|string $targetB58PubKey
     * @param int $lastNOperation
     * @param int $sender
     * @param int $target
     * @param string $amount
     * @param string $fee
     * @param string $payload
     * @param string $payloadMethod
     * @param string $pwd
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function signSendTo(
        ?string $rawOperations,
        ?int $protocol,
        ?string $senderEncPubKey,
        ?string $senderB58PubKey,
        ?string $targetEncPubKey,
        ?string $targetB58PubKey,
        int $lastNOperation,
        int $sender,
        int $target,
        string $amount,
        string $fee = '0',
        string $payload = '',
        string $payloadMethod = PascalCoin::PAYLOAD_ENC_DEST,
        string $pwd = ''
    ): array;

    /**
     * @param int $account
     * @param int $accountSigner
     * @param null|string $newEncPubKey
     * @param null|string $newB58PubKey
     * @param string $fee
     * @param string $payload
     * @param string $payloadMethod
     * @param string $pwd
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function changeKey(
        int $account,
        int $accountSigner,
        ?string $newEncPubKey,
        ?string $newB58PubKey,
        string $fee = '0',
        string $payload = '',
        string $payloadMethod = PascalCoin::PAYLOAD_ENC_DEST,
        string $pwd = ''
    ): array;

    /**
     * @param null|string $rawOperations
     * @param int|null $protocol
     * @param int $lastNOperations
     * @param null|string $oldEncPubKey
     * @param null|string $oldB58PubKey
     * @param int $account
     * @param int $accountSigner
     * @param null|string $newEncPubKey
     * @param null|string $newB58PubKey
     * @param string $fee
     * @param string $payload
     * @param string $payloadMethod
     * @param string $pwd
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return mixed
     */
    public function signChangeKey(
        ?string $rawOperations,
        ?int $protocol,
        int $lastNOperations,
        ?string $oldEncPubKey,
        ?string $oldB58PubKey,
        int $account,
        int $accountSigner,
        ?string $newEncPubKey,
        ?string $newB58PubKey,
        string $fee = '0',
        string $payload = '',
        string $payloadMethod = PascalCoin::PAYLOAD_ENC_DEST,
        string $pwd = ''
    );

    /**
     * @param array $accounts
     * @param null|string $newEncPubKey
     * @param null|string $newB58PubKey
     * @param string $fee
     * @param string $payload
     * @param string $payloadMethod
     * @param string $pwd
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function changeKeys(
        array $accounts,
        ?string $newEncPubKey,
        ?string $newB58PubKey,
        string $fee = '0',
        string $payload = '',
        string $payloadMethod = PascalCoin::PAYLOAD_ENC_DEST,
        string $pwd = ''
    ): array;

    /**
     * @param int $accountTarget
     * @param int $accountSigner
     * @param int $sellerAccount
     * @param string $price
     * @param int|null $lockedUntilBlock
     * @param null|string $newB58PubKey
     * @param null|string $newEncPubKey
     * @param string $fee
     * @param string $payload
     * @param string $payloadMethod
     * @param string $pwd
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function listAccountForSale(
        int $accountTarget,
        int $accountSigner,
        int $sellerAccount,
        string $price,
        ?int $lockedUntilBlock,
        ?string $newB58PubKey,
        ?string $newEncPubKey,
        string $fee = '0',
        string $payload = '',
        string $payloadMethod = PascalCoin::PAYLOAD_ENC_DEST,
        string $pwd = ''
    ): array;

    /**
     * @param null|string $rawOperations
     * @param int|null $protocol
     * @param int $lastNOperation
     * @param int $accountTarget
     * @param int $accountSigner
     * @param int $sellerAccount
     * @param string $price
     * @param int|null $lockedUntilBlock
     * @param string $newB58PubKey
     * @param string $newEncPubKey
     * @param string $signerB58PubKey
     * @param string $signerEncPubKey
     * @param string $fee
     * @param string $payload
     * @param string $payloadMethod
     * @param string $pwd
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return mixed
     */
    public function signListAccountForSale(
        ?string $rawOperations,
        ?int $protocol,
        int $lastNOperation,
        int $accountTarget,
        int $accountSigner,
        int $sellerAccount,
        string $price,
        ?int $lockedUntilBlock,
        string $newB58PubKey,
        string $newEncPubKey,
        string $signerB58PubKey,
        string $signerEncPubKey,
        string $fee = '0',
        string $payload = '',
        string $payloadMethod = PascalCoin::PAYLOAD_ENC_DEST,
        string $pwd = ''
    );

    /**
     * @param int $accountTarget
     * @param int $accountSigner
     * @param string $fee
     * @param string $payload
     * @param string $payloadMethod
     * @param string $pwd
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function delistAccountForSale(
        int $accountTarget,
        int $accountSigner,
        string $fee = '0',
        string $payload = '',
        string $payloadMethod = PascalCoin::PAYLOAD_ENC_DEST,
        string $pwd = ''
    ): array;

    /**
     * @param null|string $rawOperations
     * @param int|null $protocol
     * @param int $lastNOperation
     * @param string $signerEncPubKey
     * @param string $signerB58PubKey
     * @param int $accountTarget
     * @param int $accountSigner
     * @param string $fee
     * @param string $payload
     * @param string $payloadMethod
     * @param string $pwd
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function signDelistAccountForSale(
        ?string $rawOperations,
        ?int $protocol,
        int $lastNOperation,
        string $signerEncPubKey,
        string $signerB58PubKey,
        int $accountTarget,
        int $accountSigner,
        string $fee = '0',
        string $payload = '',
        string $payloadMethod = PascalCoin::PAYLOAD_ENC_DEST,
        string $pwd = ''
    ): array;

    /**
     * @param int $buyerAccount
     * @param int $accountToPurchase
     * @param int $sellerAccount
     * @param string $price
     * @param null|string $newEncPubKey
     * @param null|string $newB58PubKey
     * @param string $amount
     * @param string $fee
     * @param string $payload
     * @param string $payloadMethod
     * @param string $pwd
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function buyAccount(
        int $buyerAccount,
        int $accountToPurchase,
        int $sellerAccount,
        string $price,
        ?string $newEncPubKey,
        ?string $newB58PubKey,
        string $amount,
        string $fee = '0',
        string $payload = '',
        string $payloadMethod = PascalCoin::PAYLOAD_ENC_DEST,
        string $pwd = ''
    ): array;

    /**
     * @param null|string $rawOperations
     * @param int|null $protocol
     * @param string $signerEncPubKey
     * @param string $signerB58PubKey
     * @param int $lastNOperation
     * @param int $buyerAccount
     * @param int $accountToPurchase
     * @param int $sellerAccount
     * @param string $price
     * @param null|string $newEncPubKey
     * @param null|string $newB58PubKey
     * @param string $amount
     * @param string $fee
     * @param string $payload
     * @param string $payloadMethod
     * @param string $pwd
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function signBuyAccount(
        ?string $rawOperations,
        ?int $protocol,
        int $lastNOperation,
        string $signerEncPubKey,
        string $signerB58PubKey,
        int $buyerAccount,
        int $accountToPurchase,
        int $sellerAccount,
        string $price,
        ?string $newEncPubKey,
        ?string $newB58PubKey,
        string $amount,
        string $fee = '0',
        string $payload = '',
        string $payloadMethod = PascalCoin::PAYLOAD_ENC_DEST,
        string $pwd = ''
    ): array;

    /**
     * @param int $accountSigner
     * @param int $accountTarget
     * @param string $newEncPubKey
     * @param string $newB58PubKey
     * @param string|null $newName
     * @param int|null $newType
     * @param string $fee
     * @param string $payload
     * @param string $payloadMethod
     * @param string $pwd
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function changeAccountInfo(
        int $accountSigner,
        int $accountTarget,
        string $newEncPubKey,
        string $newB58PubKey,
        string $newName = null,
        ?int $newType = null,
        string $fee = '0',
        string $payload = '',
        string $payloadMethod = PascalCoin::PAYLOAD_ENC_DEST,
        string $pwd = ''
    ): array;

    /**
     * @param null|string $rawOperations
     * @param int|null $protocol
     * @param int $lastNOperation
     * @param string $signerEncPubKey
     * @param string $signerB58PubKey
     * @param int $accountSigner
     * @param int $accountTarget
     * @param string $newEncPubKey
     * @param string $newB58PubKey
     * @param string|null $newName
     * @param int|null $newType
     * @param string $fee
     * @param string $payload
     * @param string $payloadMethod
     * @param string $pwd
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return array
     */
    public function signChangeAccountInfo(
        ?string $rawOperations,
        ?int $protocol,
        int $lastNOperation,
        string $signerEncPubKey,
        string $signerB58PubKey,
        int $accountSigner,
        int $accountTarget,
        string $newEncPubKey,
        string $newB58PubKey,
        string $newName = null,
        ?int $newType = null,
        string $fee = '0',
        string $payload = '',
        string $payloadMethod = PascalCoin::PAYLOAD_ENC_DEST,
        string $pwd = ''
    ): array;

    /**
     * @param string $rawOperations
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return mixed
     */
    public function operationsInfo(
        string $rawOperations
    );

    /**
     * @param string $rawOperations
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return mixed
     */
    public function executeOperations(
        string $rawOperations
    );

    /**
     * @param int $ecNid
     * @param string $x
     * @param string $y
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return mixed
     */
    public function encodePubKey(
        int $ecNid,
        string $x,
        string $y
    );

    /**
     * @param string|null $encPubKey
     * @param string|null $b58PubKey
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return mixed
     */
    public function decodePubKey(
        string $encPubKey = null,
        string $b58PubKey = null
    );

    /**
     * @param string $payload
     * @param string|null $encPubKey
     * @param string|null $b58PubKey
     * @param string $payloadMethod
     * @param string $pwd
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return mixed
     */
    public function payloadEncrypt(
        string $payload,
        string $encPubKey = null,
        string $b58PubKey = null,
        string $payloadMethod = PascalCoin::PAYLOAD_ENC_DEST,
        string $pwd = ''
    );

    /**
     * @param string $payload
     * @param array $pwds
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return mixed
     */
    public function payloadDecrypt(
        string $payload,
        array $pwds = []
    );

    /**
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return mixed
     */
    public function getConnections();

    /**
     * @param int $ecNid
     * @param null|string $name
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return mixed
     */
    public function addNewKey(
        int $ecNid,
        ?string $name
    );

    /**
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return mixed
     */
    public function lock();

    /**
     * @param string $pwd
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return mixed
     */
    public function unlock(
        string $pwd
    );

    /**
     * @param string $pwd
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return mixed
     */
    public function setWalletPassword(
        string $pwd
    );

    /**
     * @param string $digest
     * @param string|null $encPubKey
     * @param string|null $b58PubKey
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return mixed
     */
    public function signMessage(
        string $digest,
        string $encPubKey = null,
        string $b58PubKey = null
    );

    /**
     * @param string $signature
     * @param string $digest
     * @param string|null $encPubKey
     * @param string|null $b58PubKey
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return mixed
     */
    public function verifySign(
        string $signature,
        string $digest,
        string $encPubKey = null,
        string $b58PubKey = null
    );

    /**
     * @param null|string $rawOperations
     * @param array $senders
     * @param array $receivers
     * @param array $changesInfo
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return mixed
     */
    public function multiOperationAddOperation(
        ?string $rawOperations,
        array $senders,
        array $receivers,
        array $changesInfo
    );

    /**
     * @param null|string $rawOperations
     * @param int|null $protocol
     * @param array $accountsAndKeys
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return mixed
     */
    public function multiOperationSignOffline(
        ?string $rawOperations,
        ?int $protocol,
        array $accountsAndKeys
    );

    /**
     * @param null|string $rawOperations
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return mixed
     */
    public function multiOperationSignOnline(
        ?string $rawOperations
    );

    /**
     * @param string $rawOperations
     * @param int $index
     *
     * @throws ErrorException
     * @throws ConnectionException
     *
     * @return mixed
     */
    public function operationsDelete(
        string $rawOperations,
        int $index
    );
}
