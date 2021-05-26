<h1 align="center"> gw-supply-chain </h1>

<p align="center"> A API SDK for gwlp supply chain.</p>


## 安装

```shell
$ composer require nason/gw-supply-chain -vvv
```

## 配置

在使用本扩展之前，你需要通过 [广物供应链平台](http://gylp.gwulp.com) 获取到接口凭证：wid 和 token。

## 使用

### 商品接口

```php
use Nason\GwSupplyChain\Product;

$wid = 'xxxxxxxxxxxxxxxxxxxxxxxx';
$token = 'xxxxxxxxxxxxxxxxxxxxxxxx';

$productApi = new Product($wid, $token);
```

#### 如：获取商品详情

```php
$goodsId = 68;

$response = $productApi->getGoodsInfo($goodsId);
```

### 类目接口

```php
use Nason\GwSupplyChain\Category;

$wid = 'xxxxxxxxxxxxxxxxxxxxxxxx';
$token = 'xxxxxxxxxxxxxxxxxxxxxxxx';

$categoryApi = new Category($wid, $token);
```

#### 获取分类列表

```php
$page = 1;
$limit = 50;

$response = $categoryApi->getCategoryList($page, $limit);
```
#### 获取单个分类数据

```php
$categoryId = 1;

$response = $categoryApi->getCategoryInfo($categoryId);
```

### 订单接口

```php
use Nason\GwSupplyChain\Order;

$wid = 'xxxxxxxxxxxxxxxxxxxxxxxx';
$token = 'xxxxxxxxxxxxxxxxxxxxxxxx';

$orderApi = new Order($wid, $token);
```

#### 如：取消订单

```php
$orderSn = 'xxxxxxxxxxxxxxxxxxxxx';

$response = $orderApi->cancelOrder($orderSn);
```

## 参考
 - [广物供应链开放平台](http://api.gylp.gwulp.com/docs.php)

## License

MIT