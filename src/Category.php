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

class Category extends BaseApi
{
    protected $servicePrefix = 'App.Category.';

    public function __construct($wid, $token)
    {
        parent::__construct($wid, $token);
    }

    public function getServicePrefix()
    {
        return $this->servicePrefix;
    }

    public function getCategoryInfo($categoryId)
    {
        $params = ['cate_id' => $categoryId];

        try {
            return $this->httpPost(ucfirst(__FUNCTION__), $params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getCategoryList($page = 1, $limit = 50)
    {
        $params = [
            'page' => $page,
            'page_count' => $limit,
        ];

        try {
            return $this->httpPost(ucfirst(__FUNCTION__), $params);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
