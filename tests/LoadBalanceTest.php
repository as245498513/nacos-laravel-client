<?php
/**
 * Created by PhpStorm.
 * User: MapleSnow
 * Date: 2022/4/7
 * Time: 15:10
 */

namespace tests;

use alibaba\nacos\util\LogUtil;
use MapleSnow\LaraNacos\Service\BaseLoadBalancer;
use MapleSnow\LoadBalance\Service\RoundRule;
use PHPUnit\Framework\TestCase;

class LoadBalanceTest extends TestCase{

    function testLp(){
        //putenv("LARAVEL_NACOS_DATAID=service-name");
        //putenv("LARAVEL_NACOS_TENANT=85dece02-efa2-4817-997e-6ceeb048dd3b");

        $roundRule = new RoundRule();
        $nacosLoadBalancer = new BaseLoadBalancer();
        while(true){

            $server = $roundRule->choose($nacosLoadBalancer);
            LogUtil::info($server->getIp() . ":" . $server->getPort());

            sleep(2);
        }
    }
}