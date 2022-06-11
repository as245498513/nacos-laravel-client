<?php

namespace MapleSnow\LaraNacos\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use MapleSnow\LaraNacos\Commands\NacosDeleteInstance;
use MapleSnow\LaraNacos\Commands\NacosGetInstance;
use MapleSnow\LaraNacos\Commands\NacosInstanceBeat;
use MapleSnow\LaraNacos\Commands\NacosRefreshConfig;
use MapleSnow\LaraNacos\Commands\NacosRegisterInstance;
use MapleSnow\LaraNacos\Commands\NacosUpdateInstance;
use Exception;

/**
 * Class ServiceProvider
 * @package RangeCore\Base\Providers
 */
class ServiceProvider extends BaseServiceProvider {

    /**
     * @throws Exception
     */
    public function boot()
    {

        $this->publishes([realpath(__DIR__.'/../Supervisord/nacos.conf') => base_path('supervisord/nacos.conf')]);
        $this->commands([
            NacosDeleteInstance::class,
            NacosGetInstance::class,
            NacosRegisterInstance::class,
            NacosUpdateInstance::class,
            NacosInstanceBeat::class,
            NacosRefreshConfig::class
        ]);
    }

}