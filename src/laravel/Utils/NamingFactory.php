<?php
/**
 * Created by PhpStorm.
 * User: MapleSnow
 * Date: 2022/4/1
 * Time: 18:25
 */

namespace MapleSnow\LaraNacos\Utils;


use alibaba\nacos\NacosConfig;
use alibaba\nacos\Naming;

class NamingFactory {

    private function __construct() {}

    public static function getInstance(){
        static $client;
        if ($client == null) {
            $host = getenv("LARAVEL_NACOS_HOST");
            $port = getenv("LARAVEL_NACOS_PORT");
            $serviceName = getenv("LARAVEL_NACOS_DATAID");
            $tenant = getenv("LARAVEL_NACOS_TENANT")?: "";

            $serverIP = IpUtil::getServerIp();
            $serverPort = getenv("SERVER_PORT") ?: 80;

            NacosConfig::setHost("$host:$port");
            $client = Naming::init(
                $serviceName,
                $serverIP,
                $serverPort,
                $tenant
            );
        }
        return $client;
    }
}