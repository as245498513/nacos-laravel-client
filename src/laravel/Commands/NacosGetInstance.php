<?php

namespace MapleSnow\LaraNacos\Commands;

use Exception;
use Illuminate\Console\Command;
use MapleSnow\LaraNacos\Utils\NamingFactory;

/**
 * 获取实例详情
 * curl -X DELETE 'http://127.0.0.1:8848/nacos/v1/ns/instance?serviceName=test-service&ip=127.0.0.1&port=8081'
 * Class NacosGetInstance
 * @package App\Console\Commands
 */
class NacosGetInstance extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nacos:get:instance';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '获取实例详情';


    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws Exception
     */
    public function handle() {
        $instances = NamingFactory::getInstance()->listInstances();

        if ($instances->getHosts()) {
            $hosts = [];
            foreach ($instances->getHosts() as $v) {
                $hosts[] = $v->getIp() . ":" . $v->getPort();
            }
            var_dump($hosts);
        } else {
            throw  new Exception("未发现实例");
        }
    }
}
