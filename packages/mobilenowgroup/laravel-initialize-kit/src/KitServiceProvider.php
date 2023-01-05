<?php

namespace MobileNowGroup\LaravelInitializeKit;

use Illuminate\Support\ServiceProvider;

class KitServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../release.sh' => base_path('release.sh'), // 发布配置文件到 laravel 的config 下
            __DIR__.'/../init.sh' => base_path('init.sh'),
        ], 'script');
    }

    public function register()
    {

    }

}