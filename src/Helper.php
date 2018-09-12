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
 * Class Helper.
 *
 * Small class with static utility methods.
 */
class Helper
{
    /**
     * Transforms the given array of arrays to an array of instances defined by
     * the given class.
     *
     * @param array $data
     * @param string $class
     *
     * @return array
     */
    public static function toArrayOfInstance(array $data, string $class)
    {
        return array_map(function ($item) use ($class) {
            return new $class($item);
        }, $data);
    }

    /**
     * @param $arr
     * @param string $key
     * @param $value
     */
    public static function addToArrayWhenNotNull(&$arr, string $key, $value)
    {
        if ($value === null) {
            return;
        }

        if ($value instanceof RpcValueInterface) {
            $arr[$key] = $value->getValue();
        } else {
            $arr[$key] = $value;
        }
    }
}
