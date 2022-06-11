<?php

namespace MapleSnow\LaraNacos\Commands;

use Exception;
use Illuminate\Console\Command;
use MapleSnow\LaraNacos\Utils\NamingFactory;

/**
 * 心跳
 * php artisan nacos:delete:instance
 * Class NacosDeleteInstance
 * @package App\Console\Commands
 */
class NacosInstanceBeat extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string */
    protected $signature = 'nacos:beat:instance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '服务持续心跳发送';


    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws Exception
     */
    public function handle() {
        $naming = NamingFactory::getInstance();
        // 注册
        $naming->register();
        while(true){
            // 发送心跳
            $naming->beat();
            sleep(5);
        }
    }
}
