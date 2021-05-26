<?php


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