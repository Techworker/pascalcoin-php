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
$rawApiClient = new RawApi($rpcClient, new EndPoint('10.0.2.2'));
$richApiClient = new RichApi(
    new RichApi\NodeApi($rawApiClient),
    new RichApi\WalletApi($rawApiClient),
    new RichApi\AccountApi($rawApiClient)
);

$pasc = new PascalCoin($rawApiClient, $richApiClient);


//print_r($pasc->getRawApi()->getConnections());

print_r($pasc->getRichApi()->node()->listConnections());
print_r($pasc->getRichApi()->node()->restart());
print_r($pasc->getRichApi()->node()->stop());
print_r($pasc->getRichApi()->node()->start());
print_r($pasc->getRichApi()->node()->addNodes('ABC'));
print_r($pasc->getRichApi()->node()->status());

print_r($pasc->getRichApi()->account()->find(123));
exit;
/*
print_r($pasc->getRichApi()->account()->find(1));
exit;


$publicKeys = $pasc->getRichApi()->wallet()->publicKeys();
foreach($publicKeys as $publicKey) {
    print_r($pasc->getRichApi()->wallet()->publicKey($publicKey));
    print_r($pasc->getRichApi()->wallet()->balance($publicKey));
    print_r($pasc->getRichApi()->wallet()->accounts($publicKey));

}
*/
$trytesArray = [
    "123465789012346578901234657890123465789012346578901234657890123465789012346578901234657890", // 90
    "123465789012346578901234657890123465789012346578901234657890123465789012346578901", // 81
    "123465789012346578901234657890123465789012346578901234657890123465789012346578901",
    "12346578901234657890123465789012346578901234657890123465789012346578901234657890A"
];

function isTrytes(string $trytes, $length = '0,')
{
    return preg_match('/^[0-9A-Z]{' . $length . '}$/', $trytes) !== 0;
}

function isArrayOfHashes(array $hashes)
{
    foreach($hashes as $hash) {
        $length = strlen($hash);
        // needs to be 81 or 90 and a valid hash
        if(!(($length === 90 || $length === 81) && isTrytes($hash, $length))) {
            return false;
        }
    }

    return true;
}

var_dump(isArrayOfHashes($trytesArray));
