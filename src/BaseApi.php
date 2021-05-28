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


use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Nason\GwSupplyChain\Exceptions\HttpException;
use Nason\GwSupplyChain\Exceptions\InvalidArgumentException;

abstract class BaseApi
{
    protected $apiUrl = 'http://api.gylp.gwulp.com/';

    protected $wid;

    protected $token;

    protected $params;

    protected $guzzleConfig = [];

    protected function __construct($wid, $token)
    {
        $this->wid = $wid;
        $this->token = $token;
    }

    public function setGuzzleConfig($config)
    {
        $this->guzzleConfig = $config;
    }

    public function getHttpClient()
    {
        return new Client($this->guzzleConfig);
    }

    protected function getAccessToken()
    {
        return md5($this->wid.$this->token.time());
    }

    protected function initBaseFields($service)
    {
        $this->params['wid'] = $this->wid;
        $this->params['token'] = $this->getAccessToken();
        $this->params['timestamp'] = time();
        $this->params['service'] = $this->getServicePrefix().$service;
    }

    public function request($method, $service, $params = [])
    {
        if (empty($method) || empty($service)) {
            throw new InvalidArgumentException('Arguments(method or service) cannot be empty');
        }

        $this->initBaseFields($service);
        $params = array_merge($this->params, $params);

        $options = [];
        if ('POST' == $method) {
            $options = [RequestOptions::FORM_PARAMS => $params];
        } elseif ('GET' == $method) {
            $options = [RequestOptions::QUERY => $params];
        }

        try {
            $response = $this->getHttpClient()
                ->request($method, $this->apiUrl, $options)
                ->getBody()
                ->getContents();

            return \json_decode($response, true);
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function httpGet($service, $params = [])
    {
        try {
            return $this->request('GET', $service, $params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function httpPost($service, $params = [])
    {
        try {
            return $this->request('POST', $service, $params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    abstract public function getServicePrefix();
}