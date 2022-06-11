<?php

namespace MapleSnow\LaraNacos\Commands;

use Exception;
use Illuminate\Console\Command;
use MapleSnow\LaraNacos\Utils\NamingFactory;

/**
 * php artisan nacos:update:instance
 * Class NacosUpdateInstance
 * @package App\Console\Commands
 */
class NacosUpdateInstance extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nacos:update:instance';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '实例更新';


    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws Exception
     */
    public function handle() {

        //fixme
        NamingFactory::getInstance()->update();
    }
}
