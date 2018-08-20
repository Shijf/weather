<?php

namespace Shijf\Weather;

use GuzzleHttp\Client;
use Shijf\Weather\Exceptions\HttpException;
use Shijf\Weather\Exceptions\InvalidArgumentException;


class Weather
{
    protected $ak;
    protected $sn;
    protected $guzzleOptions = [];

    public function __construct(string $ak,string $sn = null)
    {
        $this->ak = $ak;
        $this->sn = $sn;
    }

    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }

    public function getWeather(string $location, string $format = "json", string $coordType = null)
    {
        /**
         * api 地址
         */
        $url = 'http://api.map.baidu.com/telematics/v3/weather';
        // 1. 对 `$format` 参数进行检查，不在范围内的抛出异常。
        if(!\in_array($format,['xml','json'])){
            throw new InvalidArgumentException('Invalid response format: '. $format);
        }
        // 2. 封装 query 参数，并对空值进行过滤。
        $query = array_filter([
            'ak' => $this->ak,
            'sn' => $this->sn,
            'location' => $location,
            'output' => $format,
            'coord_type' => $coordType,
        ]);
        try{
            // 3. 调用 getHttpClient 获取实例，并调用该实例的 `get` 方法，
            // 传递参数为两个：$url、['query' => $query]，
            $respose = $this->getHttpClient()->get($url,[
                'query' => $query,
            ])->getBody()->getContents();
            // 4. 返回值根据 $format 返回不同的格式，
            // 当 $format 为 json 时，返回数组格式，否则为 xml。
            return $format === 'json' ? \json_decode($respose,true) : $respose;
        }catch(\Exception $e){
            // 5. 当调用出现异常时捕获并抛出，消息为捕获到的异常消息，
            // 并将调用异常作为 $previousException 传入。
            throw new HttpException($e->getMessage(),$e->getCode(), $e);
        }
       

        
        
    }
}