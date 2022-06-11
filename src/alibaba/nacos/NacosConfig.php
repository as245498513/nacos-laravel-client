<?php

namespace alibaba\nacos;

use Monolog\Logger;

/**
 * Class NacosConfig
 * @author suxiaolin
 * @package alibaba\nacos
 */
class NacosConfig
{
    /**
     * @var string 默认配置目录
     */
    private static $defaultConfigPath = "nacos/config";


    /**
     * @var string 快照文件存放目录
     */
    private static $snapshotPath = "nacos/snapshot";

    /**
     * @var int 长轮询等待时间, 默认30秒
     */
    private static $longPullingTimeout = 30000;

    /**
     * 日志保存路径
     *
     * @var string
     */
    private static $logPath = "php://stdout";

    /**
     * 日志级别
     *
     * @var int
     */
    private static $logLevel = Logger::INFO;

    /**
     * nacos服务器地址
     *
     * @var
     */
    private static $host;

    /**
     * 是否调试模式
     *
     * @var
     */
    private static $isDebug = false;


    /**
     * @return int
     */
    public static function getLongPullingTimeout()
    {
        return self::$longPullingTimeout;
    }

    /**
     * @param int $longPullingTimeout
     */
    public static function setLongPullingTimeout($longPullingTimeout)
    {
        self::$longPullingTimeout = $longPullingTimeout;
    }

    /**
     * @return string
     */
    public static function getSnapshotPath()
    {
        return self::$snapshotPath;
    }

    /**
     * @param string $snapshotPath
     */
    public static function setSnapshotPath($snapshotPath)
    {
        self::$snapshotPath = $snapshotPath;
    }

    /**
     * @return string
     */
    public static function getLogPath()
    {
        return self::$logPath;
    }

    /**
     * @param string $logPath
     */
    public static function setLogPath($logPath)
    {
        self::$logPath = $logPath;
    }

    /**
     * @return int
     */
    public static function getLogLevel()
    {
        return self::$logLevel;
    }

    /**
     * @param int $logLevel
     */
    public static function setLogLevel($logLevel)
    {
        self::$logLevel = $logLevel;
    }

    /**
     * @return mixed
     */
    public static function getHost()
    {
        return self::$host;
    }

    /**
     * @param mixed $host
     */
    public static function setHost($host)
    {
        self::$host = $host;
    }

    /**
     * @return mixed
     */
    public static function getIsDebug()
    {
        return self::$isDebug;
    }

    /**
     * @param mixed $isDebug
     */
    public static function setIsDebug($isDebug)
    {
        self::$isDebug = $isDebug;
    }

    public static function getDefaultPath(){
        return base_path(".env");
    }

    public static function getConfigPath(){
        return base_path(".env");
    }

    public static function getLangPath(){
        return resource_path("lang/".config("app.locale")."/lang.yml");
    }

    /**
     * @return string
     */
    public static function getDefaultConfigPath(): string {
        return self::$defaultConfigPath;
    }

    /**
     * @param string $defaultConfigPath
     */
    public static function setDefaultConfigPath(string $defaultConfigPath): void {
        self::$defaultConfigPath = $defaultConfigPath;
    }
}