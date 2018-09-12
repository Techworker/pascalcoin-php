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

namespace Test;

use Techworker\PascalCoin\EndPoint;
use Techworker\PascalCoin\PascalCoin;
use Techworker\PascalCoin\RawApi;
use Techworker\PascalCoin\RichApi;
use Techworker\PascalCoin\RPC\Curl;

require_once __DIR__.'/vendor/autoload.php';

$rpcClient = new Curl();
$rawApiClient = new RawApi($rpcClient);
$richApiClient = new RichApi(
    new RichApi\NodeApi($rawApiClient),
    new RichApi\WalletApi($rawApiClient),
    new RichApi\AccountApi($rawApiClient)
);
$pasc = new PascalCoin($rawApiClient, $richApiClient, [new EndPoint('10.0.2.2')]);


//print_r($pasc->getRawApi()->getConnections());
//print_r($pasc->getRichApi()->node()->connections());
//print_r($pasc->getRichApi()->node()->restart());


print_r($pasc->getRichApi()->account()->find(1));
exit;


$publicKeys = $pasc->getRichApi()->wallet()->publicKeys();
foreach($publicKeys as $publicKey) {
    print_r($pasc->getRichApi()->wallet()->publicKey($publicKey));
    print_r($pasc->getRichApi()->wallet()->balance($publicKey));
    print_r($pasc->getRichApi()->wallet()->accounts($publicKey));

}

