<?php


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
        $this->params['wid'] = $wid;
        $this->params['timestamp'] = time();
        $this->params['token'] = $this->getAccessToken();
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
        return md5($this->wid . $this->token . time());
    }

    public function request($method, $service, $params = [])
    {
        if (empty($method) || empty($service)) {
            throw new InvalidArgumentException('Arguments(method or service) cannot be empty');
        }

        $this->params['service'] = $this->getServicePrefix() . $service;
        $params = array_merge($this->params, $params);

        $options = [];
        if ($method == 'POST') {
            $options = [RequestOptions::FORM_PARAMS => $params];
        } elseif ($method == 'GET') {
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