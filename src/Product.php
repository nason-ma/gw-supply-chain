<?php


namespace Nason\GwSupplyChain;


use Nason\GwSupplyChain\Exceptions\InvalidArgumentException;
use Nason\GwSupplyChain\Services\ArrayService;

class Product extends BaseApi
{

    protected $servicePrefix = 'App.Goods.';

    protected $goodsListArgs = [
        'page' => 1,
        'page_count' => 50,
        'goods_id' => 0,
        'store_id' => 0,
        'brand_id' => 0,
        'cat_id3' => 0,
        'label_id' => 0,
        'profit_rate_min' => 0,
        'profit_rate_max' => 0,
        'goods_name' => '',
    ];

    protected $goodsStockStateArgs = [
        'goods_id' => 0,
        'goods_num' => 1,
        'spec_key' => '',
        'province' => '',
        'city' => '',
        'district' => '',
        'town' => '',
        'address' => '',
    ];

    public function __construct($wid, $token)
    {
        parent::__construct($wid, $token);
    }

    public function getServicePrefix()
    {
        return $this->servicePrefix;
    }

    public function getGoodsIdList($page = 1, $limit = 50, $categoryId = 0)
    {
        $params = array_filter([
            'page' => $page,
            'page_count' => $limit,
            'cat_id3' => $categoryId,
        ]);

        try {
            return $this->httpPost(ucfirst(__FUNCTION__), $params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getGoodsInfo($goodsId)
    {
        $params = ['goods_id' => $goodsId];

        try {
            return $this->httpPost(ucfirst(__FUNCTION__), $params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getGoodsList($params)
    {
        if (!is_array($params)) {
            throw new InvalidArgumentException('Argument:params type must be an array');
        }
        $params = array_filter(ArrayService::arrayOnlyFields($this->goodsListArgs, $params));

        try {
            return $this->httpPost(ucfirst(__FUNCTION__), $params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $startTime
     * @param int $type 默认0, 0:全部 1:上架或商品更新 2:商品下架 3:更新价格
     * @param int $page
     */
    public function getGoodsMessage($startTime, $type = 0, $page = 1)
    {
        $params = compact('type', 'page');
        $params['start_time'] = $startTime;

        try {
            return $this->httpPost(ucfirst(__FUNCTION__), $params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getGoodsPrice($goodsId)
    {
        $params = ['goods_id' => $goodsId];

        try {
            return $this->httpPost(ucfirst(__FUNCTION__), $params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getGoodsStoreCount($goodsId)
    {
        $params = ['goods_id' => $goodsId];

        try {
            return $this->httpPost(ucfirst(__FUNCTION__), $params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getLabelList()
    {
        try {
            return $this->httpPost(ucfirst(__FUNCTION__));
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getNewStockState($params)
    {
        if (!is_array($params)) {
            throw new InvalidArgumentException('Argument:params type must be an array');
        }
        $params = array_filter(ArrayService::arrayOnlyFields($this->goodsStockStateArgs, $params));

        try {
            return $this->httpPost(ucfirst(__FUNCTION__), $params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getSku($goodsId)
    {
        $params = ['goods_id' => $goodsId];

        try {
            return $this->httpPost(ucfirst(__FUNCTION__), $params);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}