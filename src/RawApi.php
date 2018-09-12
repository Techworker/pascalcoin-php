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

/**
 * Class RawApi.
 *
 * The remote API provides a 1to1 implementation of the RPC appi
 */
class RawApi implements RawApiInterface
{
    use HasEndpointsTrait;

    /**
     * The rpc implementation.
     *
     * @var AbstractRPCClient
     */
    protected $rpcClient;

    /**
     * RawApi constructor.
     *
     * @param AbstractRPCClient $rpcClient
     */
    public function __construct(AbstractRPCClient $rpcClient)
    {
        $this->rpcClient = $rpcClient;
    }

    /**
     * Tries to prepare the given params array by stripping out data the
     * can be stripped O_o.
     *
     * @param array $fields
     *
     * @return array
     */
    protected function prepareParams(array $fields)
    {
        return array_filter($fields, function ($value, $key) {
            // filter out empty b58_pubkey
            if (false !== strpos($key, 'enc_pubkey')) {
                return null !== $value;
            }

            // filter out empty b58_pubkey
            if (false !== strpos($key, 'b58_pubkey')) {
                return null !== $value;
            }

            if ($key === 'rawoperations' && null === $value) {
                return false;
            }

            if ($key === 'protocol' && null === $value) {
                return false;
            }

            return true;
        }, ARRAY_FILTER_USE_BOTH);
    }

    /**
     * Sends the given params to the given rpc method.
     *
     * @param string $method
     * @param array $params
     *
     * @throws RPC\ErrorException
     *
     * @return mixed
     */
    protected function send(string $method, array $params = [])
    {
        return $this->rpcClient->send(
            $method, $this->prepareParams($params), $this->getEndPoint()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function addNode(array $nodes): int
    {
        return $this->send('addnode', [
            'nodes' => implode(';', $nodes),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function nodeStatus(): array
    {
        return $this->send('nodestatus');
    }

    /**
     * {@inheritdoc}
     */
    public function startNode(): bool
    {
        return $this->send('startnode');
    }

    /**
     * {@inheritdoc}
     */
    public function stopNode(): bool
    {
        return $this->send('stopnode');
    }

    /**
     * {@inheritdoc}
     */
    public function getWalletAccounts(string $encPubKey = null,
                                      string $b58PubKey = null,
                                      int $start = 0,
                                      int $max = 100): array
    {
        return $this->send('getwalletaccounts', [
            'enc_pubkey' => $encPubKey,
            'b58_pubkey' => $b58PubKey,
            'start' => $start,
            'max' => $max,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getWalletAccountsCount(string $encPubKey = null,
                                           string $b58PubKey = null,
                                           int $start = 0,
                                           int $max = 100): int
    {
        return $this->send('getwalletaccountscount', [
            'enc_pubkey' => $encPubKey,
            'b58_pubkey' => $b58PubKey,
            'start' => $start,
            'max' => $max,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getWalletPubKeys(int $start = 0,
                                     int $max = 100): array
    {
        return $this->send('getwalletpubkeys', [
            'start' => $start,
            'max' => $max,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getWalletPubKey(string $encPubKey = null,
                                    string $b58PubKey = null): array
    {
        return $this->send('getwalletpubkey', [
            'enc_pubkey' => $encPubKey,
            'b58_pubkey' => $b58PubKey,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getWalletCoins(string $encPubKey = null,
                                   string $b58PubKey = null)
    {
        return $this->send('getwalletcoins', [
            'enc_pubkey' => $encPubKey,
            'b58_pubkey' => $b58PubKey,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlock(int $block): array
    {
        return $this->send('getblock', [
            'block' => $block,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlocks(int $last = 0,
                              int $start = 0,
                              int $end = 0,
                              int $max = 0): array
    {
        return $this->send('getblocks', [
            'last' => $last,
            'start' => $start,
            'end' => $end,
            'max' => $max,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockCount(): int
    {
        return $this->send('getblockcount');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockOperation(int $block,
                                      int $opBlock = 0): array
    {
        return $this->send('getblockoperation', [
            'block' => $block,
            'opblock' => $opBlock,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockOperations(int $block,
                                       int $start = 0,
                                       int $max = 100): array
    {
        return $this->send('getblockoperations', [
            'block' => $block,
            'start' => $start,
            'max' => $max,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getAccount(int $account): array
    {
        return $this->send('getaccount', [
            'account' => $account,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getAccountOperations(int $account,
                                         int $depth = 100,
                                         int $startBlock = 0,
                                         int $start = 0,
                                         int $max = 100): array
    {
        return $this->send('getaccountoperations', [
            'account' => $account,
            'depth' => $depth,
            'start_block' => $startBlock,
            'start' => $start,
            'max' => $max,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getPendings(int $start = 0,
                                int $max = 100): array
    {
        return $this->send('getpendings', [
            'start' => $start,
            'max' => $max,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getPendingsCount(): int
    {
        return $this->send('getpendingscount');
    }

    /**
     * {@inheritdoc}
     */
    public function decodeOpHash(string $opHash): array
    {
        return $this->send('decodeophash', [
            'ophash' => $opHash,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function findOperation(string $opHash): array
    {
        return $this->send('findoperation', [
            'ophash' => $opHash,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function findNOperation(int $account,
                                   int $block = 0,
                                   int $nOperation = 0): array
    {
        return $this->send('findnoperation', [
            'account' => $account,
            'block' => $block,
            'n_operation' => $nOperation,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function findNOperations(int $account,
                                    int $startBlock = 0,
                                    int $nOperationMin = 0,
                                    int $nOperationMax = 0): array
    {
        return $this->send('findnoperations', [
            'account' => $account,
            'start_block' => $startBlock,
            'n_operation_min' => $nOperationMin,
            'n_operation_max' => $nOperationMax,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function findAccounts(string $name = '',
                                 int $type = -1,
                                 bool $listed = false,
                                 bool $exact = true,
                                 string $minBalance = '-1',
                                 string $maxBalance = '-1',
                                 int $start = 0,
                                 int $max = 100): array
    {
        return $this->send('findaccounts', [
            'name' => $name,
            'type' => $type,
            'listed' => $listed,
            'exact' => $exact,
            'min_balance' => $minBalance,
            'max_balance' => $maxBalance,
            'start' => $start,
            'max' => $max,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function sendTo(int $sender,
                           int $target,
                           string $amount,
                           string $fee = '0',
                           string $payload = '',
                           string $payloadMethod = PascalCoin::PAYLOAD_ENC_DEST,
                           string $pwd = ''): array
    {
        return $this->send('sendto', [
            'sender' => $sender,
            'target' => $target,
            'amount' => $amount,
            'fee' => $fee,
            'payload' => $payload,
            'payload_method' => $payloadMethod,
            'pwd' => $pwd,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function signSendTo(?string $rawOperations,
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
                               string $pwd = ''): array
    {
        return $this->send('signsendto', [
            'rawoperations' => $rawOperations,
            'protocol' => $protocol,
            'sender_enc_pubkey' => $senderEncPubKey,
            'sender_b58_pubkey' => $senderB58PubKey,
            'target_enc_pubkey' => $targetEncPubKey,
            'target_b58_pubkey' => $targetB58PubKey,
            'last_n_operation' => $lastNOperation,
            'sender' => $sender,
            'target' => $target,
            'amount' => $amount,
            'fee' => $fee,
            'payload' => $payload,
            'payload_method' => $payloadMethod,
            'pwd' => $pwd,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function changeKey(int $account,
                              int $accountSigner,
                              ?string $newEncPubKey,
                              ?string $newB58PubKey,
                              string $fee = '0',
                              string $payload = '',
                              string $payloadMethod = PascalCoin::PAYLOAD_ENC_DEST,
                              string $pwd = ''): array
    {
        return $this->send('changekey', [
            'account' => $account,
            'account_signer' => $accountSigner,
            'new_enc_pubkey' => $newEncPubKey,
            'new_b58_pubkey' => $newB58PubKey,
            'fee' => $fee,
            'payload' => $payload,
            'payload_method' => $payloadMethod,
            'pwd' => $pwd,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function signChangeKey(?string $rawOperations,
                                  ?int $protocol,
                                  int $lastNOperation,
                                  ?string $oldEncPubKey,
                                  ?string $oldB58PubKey,
                                  int $account,
                                  int $accountSigner,
                                  ?string $newEncPubKey,
                                  ?string $newB58PubKey,
                                  string $fee = '0',
                                  string $payload = '',
                                  string $payloadMethod = PascalCoin::PAYLOAD_ENC_DEST,
                                  string $pwd = '')
    {
        return $this->send('signchangekey', [
            'rawoperations' => $rawOperations,
            'protocol' => $protocol,
            'last_n_operation' => $lastNOperation,
            'old_enc_pubkey' => $oldEncPubKey,
            'old_b58_pubkey' => $oldB58PubKey,
            'account' => $account,
            'account_signer' => $accountSigner,
            'new_enc_pubkey' => $newEncPubKey,
            'new_b58_pubkey' => $newB58PubKey,
            'fee' => $fee,
            'payload' => $payload,
            'payload_method' => $payloadMethod,
            'pwd' => $pwd,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function changeKeys(array $accounts,
                               ?string $newEncPubKey,
                               ?string $newB58PubKey,
                               string $fee = '0',
                               string $payload = '',
                               string $payloadMethod = PascalCoin::PAYLOAD_ENC_DEST,
                               string $pwd = ''): array
    {
        return $this->send('changekeys', [
            'accounts' => $accounts,
            'new_enc_pubkey' => $newEncPubKey,
            'new_b58_pubkey' => $newB58PubKey,
            'fee' => $fee,
            'payload' => $payload,
            'payload_method' => $payloadMethod,
            'pwd' => $pwd,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function listAccountForSale(int $accountTarget,
                                       int $accountSigner,
                                       int $sellerAccount,
                                       string $price,
                                       ?int $lockedUntilBlock,
                                       ?string $newB58PubKey,
                                       ?string $newEncPubKey,
                                       string $fee = '0',
                                       string $payload = '',
                                       string $payloadMethod = PascalCoin::PAYLOAD_ENC_DEST,
                                       string $pwd = ''): array
    {
        return $this->send('listaccountforsale', [
            'account_target' => $accountTarget,
            'account_signer' => $accountSigner,
            'seller_account' => $sellerAccount,
            'price' => $price,
            'locked_until_block' => $lockedUntilBlock,
            'new_enc_pubkey' => $newEncPubKey,
            'new_b58_pubkey' => $newB58PubKey,
            'fee' => $fee,
            'payload' => $payload,
            'payload_method' => $payloadMethod,
            'pwd' => $pwd,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function signListAccountForSale(?string $rawOperations,
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
                                           string $pwd = '')
    {
        return $this->send('signlistaccountforsale', [
            'rawoperations' => $rawOperations,
            'protocol' => $protocol,
            'last_n_operation' => $lastNOperation,
            'account_target' => $accountTarget,
            'account_signer' => $accountSigner,
            'seller_account' => $sellerAccount,
            'price' => $price,
            'locked_until_block' => $lockedUntilBlock,
            'new_enc_pubkey' => $newEncPubKey,
            'new_b58_pubkey' => $newB58PubKey,
            'signer_enc_pubkey' => $signerEncPubKey,
            'signer_b58_pubkey' => $signerB58PubKey,
            'fee' => $fee,
            'payload' => $payload,
            'payload_method' => $payloadMethod,
            'pwd' => $pwd,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function delistAccountForSale(int $accountTarget,
                                         int $accountSigner,
                                         string $fee = '0',
                                         string $payload = '',
                                         string $payloadMethod = PascalCoin::PAYLOAD_ENC_DEST,
                                         string $pwd = ''): array
    {
        return $this->send('delistaccountforsale', [
            'account_target' => $accountTarget,
            'account_signer' => $accountSigner,
            'fee' => $fee,
            'payload' => $payload,
            'payload_method' => $payloadMethod,
            'pwd' => $pwd,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function signDelistAccountForSale(?string $rawOperations,
                                             ?int $protocol,
                                             int $lastNOperation,
                                             string $signerEncPubKey,
                                             string $signerB58PubKey,
                                             int $accountTarget,
                                             int $accountSigner,
                                             string $fee = '0',
                                             string $payload = '',
                                             string $payloadMethod = PascalCoin::PAYLOAD_ENC_DEST,
                                             string $pwd = ''): array
    {
        return $this->send('signdelistaccountforsale', [
            'rawoperations' => $rawOperations,
            'protocol' => $protocol,
            'last_n_operation' => $lastNOperation,
            'signer_enc_pubkey' => $signerEncPubKey,
            'signer_b58_pubkey' => $signerB58PubKey,
            'account_target' => $accountTarget,
            'account_signer' => $accountSigner,
            'fee' => $fee,
            'payload' => $payload,
            'payload_method' => $payloadMethod,
            'pwd' => $pwd,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function buyAccount(int $buyerAccount,
                               int $accountToPurchase,
                               int $sellerAccount,
                               string $price,
                               ?string $newEncPubKey,
                               ?string $newB58PubKey,
                               string $amount,
                               string $fee = '0',
                               string $payload = '',
                               string $payloadMethod = PascalCoin::PAYLOAD_ENC_DEST,
                               string $pwd = ''): array
    {
        return $this->send('buyaccount', [
            'buyer_account' => $buyerAccount,
            'account_to_purchase' => $accountToPurchase,
            'seller_account' => $sellerAccount,
            'price' => $price,
            'new_enc_pubkey' => $newEncPubKey,
            'new_b58pubkey' => $newB58PubKey,
            'amount' => $amount,
            'fee' => $fee,
            'payload' => $payload,
            'payload_method' => $payloadMethod,
            'pwd' => $pwd,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function signBuyAccount(?string $rawOperations,
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
                                   string $pwd = ''): array
    {
        return $this->send('signbuyaccount', [
            'rawoperations' => $rawOperations,
            'protocol' => $protocol,
            'last_n_operation' => $lastNOperation,
            'signer_enc_pubkey' => $signerEncPubKey,
            'signer_b58_pubkey' => $signerB58PubKey,
            'buyer_account' => $buyerAccount,
            'account_to_purchase' => $accountToPurchase,
            'seller_account' => $sellerAccount,
            'price' => $price,
            'new_enc_pubkey' => $newEncPubKey,
            'new_b58pubkey' => $newB58PubKey,
            'amount' => $amount,
            'fee' => $fee,
            'payload' => $payload,
            'payload_method' => $payloadMethod,
            'pwd' => $pwd,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function changeAccountInfo(int $accountSigner,
                                      int $accountTarget,
                                      string $newEncPubKey,
                                      string $newB58PubKey,
                                      string $newName = null,
                                      ?int $newType = null,
                                      string $fee = '0',
                                      string $payload = '',
                                      string $payloadMethod = PascalCoin::PAYLOAD_ENC_DEST,
                                      string $pwd = ''): array
    {
        return $this->send('changeaccountinfo', [
            'account_signer' => $accountSigner,
            'account_target' => $accountTarget,
            'new_enc_pubkey' => $newEncPubKey,
            'new_b58pubkey' => $newB58PubKey,
            'new_name' => $newName,
            'new_type' => $newType,
            'fee' => $fee,
            'payload' => $payload,
            'payload_method' => $payloadMethod,
            'pwd' => $pwd,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function signChangeAccountInfo(?string $rawOperations,
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
                                          string $pwd = ''): array
    {
        return $this->send('signchangeaccountinfo', [
            'rawoperations' => $rawOperations,
            'protocol' => $protocol,
            'last_n_operation' => $lastNOperation,
            'signer_enc_pubkey' => $signerEncPubKey,
            'signer_b58_pubkey' => $signerB58PubKey,
            'account_signer' => $accountSigner,
            'account_target' => $accountTarget,
            'new_enc_pubkey' => $newEncPubKey,
            'new_b58pubkey' => $newB58PubKey,
            'new_name' => $newName,
            'new_type' => $newType,
            'fee' => $fee,
            'payload' => $payload,
            'payload_method' => $payloadMethod,
            'pwd' => $pwd,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function operationsInfo(string $rawOperations)
    {
        return $this->send('operationsinfo', [
            'rawoperations' => $rawOperations,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function executeOperations(string $rawOperations)
    {
        return $this->send('executeoperations', [
            'rawoperations' => $rawOperations,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function encodePubKey(int $ecNid,
                                 string $x,
                                 string $y)
    {
        return $this->send('encodepubkey', [
            'ec_nid' => $ecNid,
            'x' => $x,
            'y' => $y,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function decodePubKey(string $encPubKey = null,
                                 string $b58PubKey = null)
    {
        return $this->send('decodepubkey', [
            'enc_pubkey' => $encPubKey,
            'b58_pubkey' => $b58PubKey,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function payloadEncrypt(string $payload,
                                   string $encPubKey = null,
                                   string $b58PubKey = null,
                                   string $payloadMethod = PascalCoin::PAYLOAD_ENC_DEST,
                                   string $pwd = '')
    {
        return $this->send('payloadencrypt', [
            'payload' => $payload,
            'enc_pubkey' => $encPubKey,
            'b58_pubkey' => $b58PubKey,
            'payload_method' => $payloadMethod,
            'pwd' => $pwd,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function payloadDecrypt(string $payload,
                                   array $pwds = [])
    {
        return $this->send('payloaddecrypt', [
            'payload' => $payload,
            'pwds' => $pwds,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getConnections()
    {
        return $this->send('getconnections');
    }

    /**
     * {@inheritdoc}
     */
    public function addNewKey(int $ecNid,
                              ?string $name)
    {
        return $this->send('addnewkey', [
            'ec_nid' => $ecNid,
            'name' => $name,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function lock()
    {
        return $this->send('lock');
    }

    /**
     * {@inheritdoc}
     */
    public function unlock(string $pwd)
    {
        return $this->send('unlock', [
            'pwd' => $pwd,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function setWalletPassword(string $pwd)
    {
        return $this->send('setwalletpassword', [
            'pwd' => $pwd,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function signMessage(string $digest,
                                string $encPubKey = null,
                                string $b58PubKey = null)
    {
        return $this->send('signmessage', [
            'digest' => $digest,
            'enc_pubkey' => $encPubKey,
            'b58_pubkey' => $b58PubKey,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function verifySign(string $signature,
                               string $digest,
                               string $encPubKey = null,
                               string $b58PubKey = null)
    {
        return $this->send('verifysign', [
            'signature' => $signature,
            'digest' => $digest,
            'enc_pubkey' => $encPubKey,
            'b58_pubkey' => $b58PubKey,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function multiOperationAddOperation(?string $rawOperations,
                                               array $senders,
                                               array $receivers,
                                               array $changesInfo)
    {
        return $this->send('multioperationaddoperation', [
            'rawoperations' => $rawOperations,
            'senders' => $senders,
            'receivers' => $receivers,
            'changesinfo' => $changesInfo,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function multiOperationSignOffline(?string $rawOperations,
                                              ?int $protocol,
                                              array $accountsAndKeys)
    {
        return $this->send('multioperationsignoffline', [
            'rawoperations' => $rawOperations,
            'protocol' => $protocol,
            'accounts_and_keys' => $accountsAndKeys,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function multiOperationSignOnline(?string $rawOperations)
    {
        return $this->send('multioperationsignonline', [
            'rawoperations' => $rawOperations,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function operationsDelete(string $rawOperations,
                                     int $index)
    {
        return $this->send('operationsdelete', [
            'rawoperations' => $rawOperations,
            'index' => $index,
        ]);
    }
}
