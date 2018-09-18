<?php

namespace Test;

use Techworker\PascalCoin\EndPoint;
use Techworker\PascalCoin\PascalCoin;
use Techworker\PascalCoin\RawApi;
use Techworker\PascalCoin\RichApi;
use Techworker\PascalCoin\RPC\Curl;

require_once __DIR__ . '/vendor/autoload.php';

$rpcClient = new Curl();
$rawApiClient = new RawApi($rpcClient, new EndPoint('10.0.2.2'));
$richApiClient = new RichApi(
    new RichApi\NodeApi($rawApiClient),
    new RichApi\WalletApi($rawApiClient),
    new RichApi\AccountApi($rawApiClient),
    new RichApi\BlockApi($rawApiClient)
);

$pasc = new PascalCoin($rawApiClient, $richApiClient);

$pasc->getRichApi()->block()->listLast(10);

