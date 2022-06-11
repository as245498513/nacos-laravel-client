<?php


namespace alibaba\nacos;


use alibaba\nacos\failover\LocalConfigInfoProcessor;

/**
 * Class DummyNacosClient
 * @author suxiaolin
 * @package alibaba\nacos
 */
class DummyNacosClient implements NacosClientInterface
{
    public static function get($dataId, $group, $tenant)
    {
        $config = "";
        LocalConfigInfoProcessor::saveSnapshot($dataId, $group, $tenant, $config);
        return $config;
    }

    public static function listener($dataId, $group, $tenant)
    {
        do {
            // 短暂休息会儿
            usleep(500);
        } while (true);
    }

    public static function publish($dataId, $group, $content, $tenant = "")
    {
        return true;
    }

    public static function delete($dataId, $group, $tenant)
    {
        return true;
    }
}