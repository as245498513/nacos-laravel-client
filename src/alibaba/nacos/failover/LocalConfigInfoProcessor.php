<?php


namespace alibaba\nacos\failover;


use alibaba\nacos\util\LogUtil;
use SplFileInfo;
use alibaba\nacos\NacosConfig;

/**
 * Class LocalConfigInfoProcessor
 * @author suxiaolin
 * @package alibaba\nacos\failover
 */
class LocalConfigInfoProcessor extends Processor
{
    const DS = DIRECTORY_SEPARATOR;

    /**
     * 获取本地默认配置内容。
     * @param $dataId
     * @param $group
     * @param $tenant
     * @return false|string|null
     */
    public static function getFailover($dataId, $group, $tenant)
    {
        $failoverFile = self::getFailoverFile($dataId, $group, $tenant);
        if (!is_file($failoverFile)) {
            return null;
        }
        return file_get_contents($failoverFile);
    }

    public static function getFailoverFile($dataId, $group, $tenant = null)
    {
        return NacosConfig::getDefaultConfigPath() . self::DS . ($tenant ?: "public"). self::DS
            . $group. self::DS . $dataId;
    }

    /**
     * 获取本地缓存文件内容。NULL表示没有本地文件或抛出异常。
     * @param $dataId
     * @param $group
     * @param $tenant
     * @return false|string|null
     */
    public static function getSnapshot($dataId, $group, $tenant)
    {
        $snapshotFile = self::getSnapshotFile($dataId, $group, $tenant);
        if (!is_file($snapshotFile)) {
            return null;
        }
        return file_get_contents($snapshotFile);
    }

    public static function getSnapshotFile($dataId, $group, $tenant)
    {
        return NacosConfig::getSnapshotPath() . self::DS . ($tenant ?: "public"). self::DS
            . $group. self::DS . $dataId;
    }

    public static function saveSnapshot($dataId, $group, $tenant, $config)
    {
        $snapshotFile = self::getSnapshotFile($dataId, $group, $tenant);
        if (!$config) {
            @unlink($snapshotFile);
        } else {
            $file = new SplFileInfo($snapshotFile);
            if (!is_dir($file->getPath())) {
                mkdir($file->getPath(), 0777, true);
            }
            file_put_contents($snapshotFile, $config);
        }
    }

}
