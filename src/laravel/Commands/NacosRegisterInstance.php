<?php

namespace MapleSnow\LaraNacos\Commands;

use Exception;
use Illuminate\Console\Command;
use MapleSnow\LaraNacos\Utils\NamingFactory;

/**
 * 实例注册
 * curl -X POST 'http://127.0.0.1:8848/nacos/v1/ns/instance?serviceName=test-service&ip=127.0.0.1&port=8081'
 * php artisan nacos:register:instance
 * Class NacosRegisterInstance
 * @package App\Console\Commands
 */
class NacosRegisterInstance extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nacos:register:instance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '实例注册';


    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws Exception
     */
    public function handle() {
        // 服务注册
        NamingFactory::getInstance()->register();
    }
}
