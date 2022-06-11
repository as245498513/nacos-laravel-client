<?php
/**
 * Created by PhpStorm.
 * User: MapleSnow
 * Date: 2022/4/7
 * Time: 14:16
 */

namespace MapleSnow\LaraNacos\Service;


use alibaba\nacos\model\Host;
use MapleSnow\LaraNacos\Model\Server4Nacos;
use MapleSnow\LaraNacos\Utils\NamingFactory;
use MapleSnow\LoadBalance\Contract\ILoadBalancer;
use MapleSnow\LoadBalance\Model\Server;
use Exception;

class BaseLoadBalancer implements ILoadBalancer {

    /**
     * @return array|Server[]
     * @throws Exception
     */
    function getServerList() {
        $instances = NamingFactory::getInstance()->listInstances();
        if(is_null($instances)){
            return [];
        }
        return $this->convertServers($instances->getHosts());
    }


    private function convertServers(array $hosts) {
        $servers = [];
        foreach ($hosts as $host){

            /**
             * @var Host $host
             */
            $server = new Server4Nacos();
            $server->setIp($host->getIp());
            $server->setPort($host->getPort());
            $server->setEnabled((bool)$host->getEnabled());
            $server->setHealthy((bool)$host->getHealthy());

            $servers[] = $server;
        }

        return $servers;
    }
}