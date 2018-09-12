<?php

namespace Techworker\PascalCoin\RichApi;

use Techworker\PascalCoin\Helper;
use Techworker\PascalCoin\Type\Account;
use Techworker\PascalCoin\Type\PublicKey;
use Techworker\PascalCoin\Type\Simple\AccountNumber;
use Techworker\PascalCoin\Type\Simple\Base58PublicKey;
use Techworker\PascalCoin\Type\Simple\EncodedPublicKey;
use Techworker\PascalCoin\Type\Simple\PublicKeyInterface;
use Techworker\CryptoCurrency\Currencies\PascalCoin as PascalCoinCurrency;

/**
 * Class WalletApi
 *
 * Contains method related to the wallet in the node.
 */
class WalletApi extends AbstractRichApi
    implements WalletApiInterface
{
    public function listAccounts(PublicKeyInterface $publicKey = null,
                             int $start = 0,
                             int $max = 100): array
    {
        $this->rawApi->getWalletAccounts(
            $this->getPublicKeyValue($publicKey, EncodedPublicKey::class),
            $this->getPublicKeyValue($publicKey, Base58PublicKey::class),
            $start,
            $max
        );
    }

    public function countAccounts(PublicKeyInterface $publicKey = null,
                                  int $start = 0,
                                  int $max = 100): int
    {
        $this->rawApi->getWalletAccountsCount(
            $this->getPublicKeyValue($publicKey, EncodedPublicKey::class),
            $this->getPublicKeyValue($publicKey, Base58PublicKey::class),
            $start,
            $max
        );
    }

    public function listPublicKeys(int $start = 0,
                               int $max = 100): array
    {
        return Helper::toArrayOfInstance(
            $this->rawApi->getWalletPubKeys($start, $max),
            PublicKey::class
        );
    }

    public function findPublicKey(PublicKeyInterface $publicKey): PublicKey
    {
        return new PublicKey($this->rawApi->getWalletPubKey(
            $this->getPublicKeyValue($publicKey, EncodedPublicKey::class),
            $this->getPublicKeyValue($publicKey, Base58PublicKey::class)
        ));
    }

    public function getBalance(PublicKeyInterface $publicKey): PascalCoinCurrency
    {
        return new PascalCoinCurrency($this->rawApi->getWalletCoins(
            $this->getPublicKeyValue($publicKey, EncodedPublicKey::class),
            $this->getPublicKeyValue($publicKey, Base58PublicKey::class)
        ));
    }
}
