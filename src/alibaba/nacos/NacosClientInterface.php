<?php


namespace alibaba\nacos;


use alibaba\nacos\exception\RequestUriRequiredException;
use alibaba\nacos\exception\RequestVerbRequiredException;
use alibaba\nacos\exception\ResponseCodeErrorException;
use ReflectionException;

/**
 * Class NacosClientInterface
 * @author suxiaolin
 * @package alibaba\nacos
 */
interface NacosClientInterface
{
    /**
     * @param $dataId
     * @param $group
     * @param $tenant
     * @return false|string|null
     */
    public static function get($dataId, $group, $tenant);

    /**
     * @param $env
     * @param $dataId
     * @param $group
     * @param $config
     * @param string $tenant
     */
    public static function listener($dataId, $group, $tenant);

    /**
     * @param $dataId
     * @param $group
     * @param $content
     * @param string $tenant
     * @return bool
     */
    public static function publish($dataId, $group, $content, $tenant = "");

    /**
     * @param $dataId
     * @param $group
     * @param $tenant
     * @return bool true 删除成功
     * @throws ReflectionException
     * @throws RequestUriRequiredException
     * @throws RequestVerbRequiredException
     * @throws ResponseCodeErrorException
     */
    public static function delete($dataId, $group, $tenant);
}