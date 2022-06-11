<?php

namespace MapleSnow\LaraNacos\Commands;

use Exception;
use Illuminate\Console\Command;
use MapleSnow\LaraNacos\Utils\NamingFactory;

/**
 * 注销实例
 * curl -X DELETE 'http://127.0.0.1:8848/nacos/v1/ns/instance?serviceName=test-service&ip=127.0.0.1&port=8081'
 * php artisan nacos:delete:instance
 * Class NacosDeleteInstance
 * @package App\Console\Commands
 */
class NacosDeleteInstance extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string */
    protected $signature = 'nacos:delete:instance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '注销实例';


    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws Exception
     */
    public function handle() {
        NamingFactory::getInstance()->delete();
    }
}
