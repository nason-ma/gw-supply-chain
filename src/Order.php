<?php

/*
 * This file is part of the nason/gw_supply_chain.
 *
 * (c) nason <mananxun99@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Nason\GwSupplyChain;

use Nason\GwSupplyChain\Exceptions\InvalidArgumentException;
use Nason\GwSupplyChain\Services\ArrayService;

class Order extends BaseApi
{
    protected $servicePrefix = 'App.Order.';

    protected $returnOrderArgs = [
        'order_sn' => '',
        'type' => '', // 0仅退款 1退货退款 2换货 3维修
        'reason' => '',
        'describe' => '',
        'goods_id' => '',
        'spec_key' => '',
        'callback_url' => '',
    ];

    protected $submitOrderArgs = [
        'platform_sn' => '',
        'consignee' => '',
        'mobile' => '',
        'province' => '',
        'city' => '',
        'district' => '',
        'town' => '',
        'address' => '',
        'goods' => [],
        'zipcode' => '',
        'user_note' => '',
        'call_back_url' => '',
    ];

    public function __construct($wid, $token)
    {
        parent::__construct($wid, $token);
    }

    public function getServicePrefix()
    {
        return $this->servicePrefix;
    }

    public function returnOrder($params)
    {
        if (!is_array($params)) {
            throw new InvalidArgumentException('Argument:params type must be an array');
        }
        $params = array_filter(ArrayService::arrayOnlyFields($this->returnOrderArgs, $params));

        try {
            return $this->httpPost('Return_order', $params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function cancelOrder($orderSn)
    {
        $params = ['order_sn' => $orderSn];

        try {
            return $this->httpPost(ucfirst(__FUNCTION__), $params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getFreight($province, $goods)
    {
        if (!is_array($goods)) {
            throw new InvalidArgumentException('Argument:goods type must be an array');
        }
        $params = compact('province', 'goods');

        try {
            return $this->httpPost(ucfirst(__FUNCTION__), $params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getLogisticsInfo($orderSn)
    {
        $params = ['order_sn' => $orderSn];

        try {
            return $this->httpPost(ucfirst(__FUNCTION__), $params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getOrderByOrderSn($orderSn, $platformSn)
    {
        $params = [
            'order_sn' => $orderSn,
            'platform_sn' => $platformSn,
        ];

        try {
            return $this->httpPost(ucfirst(__FUNCTION__), $params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function payAfterStatus($orderSn)
    {
        $params = ['order_sn' => $orderSn];

        try {
            return $this->httpPost(ucfirst(__FUNCTION__), $params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function submitOrder($params)
    {
        if (!is_array($params)) {
            throw new InvalidArgumentException('Argument:params type must be an array');
        }
        $params = array_filter(ArrayService::arrayOnlyFields($this->submitOrderArgs, $params));

        try {
            return $this->httpPost(__FUNCTION__, $params);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
