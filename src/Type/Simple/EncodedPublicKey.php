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

namespace Techworker\PascalCoin\Type\Simple;

/**
 * Class EncodedPublicKey.
 *
 * A simple Encoded public key.
 */
class EncodedPublicKey extends HexaString implements PublicKeyInterface
{
    public function __construct(string $value)
    {
        if ($value instanceof self) {
            parent::__construct($value->value);
        } else {
            parent::__construct($value);
        }
    }
}
