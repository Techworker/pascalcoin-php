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

use Techworker\PascalCoin\HasEndpointsTrait;
use Techworker\PascalCoin\RawApiInterface;
use Techworker\PascalCoin\Type\PublicKey;
use Techworker\PascalCoin\Type\RpcValueInterface;
use Techworker\PascalCoin\Type\Simple\EncodedPublicKey;
use Techworker\PascalCoin\Type\Simple\PublicKeyInterface;

abstract class AbstractRichApi
{
    use HasEndpointsTrait;

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
}
