<?php

namespace App\Providers;

use App\Services\Computer;
use App\Services\House;
use App\Services\Interfaces\ComputerInterface;
use App\Services\Interfaces\HouseInterface;
use App\Services\Light;
use App\Services\PodcastParser;
use App\Services\Transistor;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(Transistor::class, function ($app, $id) {
            return new Transistor($app->make(PodcastParser::class), $id);
        });

        $this->app->bind(ComputerInterface::class,Computer::class);

        $this->app->when(Light::class)->needs('$position')->give('bathroom');

        $this->app->bind(HouseInterface::class, House::class);

//        $this->app->bind(HouseInterface::class, function ($app) {
//            return new House($app->make(Light::class));
//        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
