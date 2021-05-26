<?php

/*
 * This file is part of the nason/gw_supply_chain.
 *
 * (c) nason <mananxun99@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Nason\GwSupplyChain\Services;

class ArrayService
{
    public static function arrayOnlyFields($array, $params)
    {
        if (empty($array)) {
            return $params;
        }
        foreach ($array as $key => $value) {
            if (!isset($params[$key])) {
                continue;
            }
            $array[$key] = $params[$key];
        }

        return $array;
    }
}
