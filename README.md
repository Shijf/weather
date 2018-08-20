<h1 align="center"> weather </h1>

<p align="center"> 基于百度地图接口的 PHP 天气信息组件。</p>


## 安装

```shell
$ composer require shijf/weather -vvv
```

## 用法

```shell
use Overtrue\Weather\Weather;

$ak = 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';

$weather = new Weather($ak);

// 返回数组格式
$response = $weather->getWeather('深圳');

// 批量获取
$response = $weather->getWeather('深圳|北京');

// 返回 XML 格式
$response = $weather->getWeather('深圳', 'xml');

// 按坐标获取
$response = $weather->getWeather('116.30,39.98', 'json');

// 批量坐标获取
$response = $weather->getWeather('116.43,40.75|120.22,43,33', 'json');

// 自定义坐标格式（coord_type）
$response = $weather->getWeather('116.306411,39.981839', 'json', 'bd09ll');
```



# 参数说明

```$xslt
array | string   getWeather(string $location, string $format = 'json', string $coordType = null)
```
## License

MIT