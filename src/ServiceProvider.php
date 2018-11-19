<?php
/**
 * Created by PhpStorm.
 * User: Shijf
 * Date: 2018/11/19 0019
 * Time: 下午 1:30
 */

namespace Shijf\Weather;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(Weather::class, function(){
            return new Weather(config('services.weather.key'));
        });

        $this->app->alias(Weather::class, 'weather');
    }

    public function provides()
    {
        return [Weather::class, 'weather'];
    }
}