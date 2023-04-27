<?php

namespace MapleSnow\LaraNacos\Commands;

use alibaba\nacos\failover\LocalConfigInfoProcessor;
use alibaba\nacos\listener\config\ListenerConfigSuccessListener;
use alibaba\nacos\Nacos;
use alibaba\nacos\NacosConfig;
use Exception;
use Illuminate\Console\Command;

class NacosRefreshConfig extends Command
{

    const PHP_COMMON_PREFIX = "php-common_";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nacos:refresh {--type=} {--listen-common}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '从nacos配置中心获取配置或语言包';


    // 配置文件目录
    private $configFilePath;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {

        parent::__construct();
    }

    /**
     * @throws Exception
     */
    public function handle() {

        $type = $this->option("type");
        // 是否监听公共配置/语言包
        $hasListenCommon = $this->option("listen-common");

        if ($type) {
            $dataId = getenv("LARAVEL_NACOS_DATAID") . "_" . $type;
            $this->configFilePath = call_user_func([NacosConfig::class, "get" . ucfirst($type) . "Path"]);
        } else {
            $this->configFilePath = NacosConfig::getDefaultPath();
            $dataId = getenv("LARAVEL_NACOS_DATAID");
        }
        $groupId = getenv("LARAVEL_NACOS_GROUPID");
        $tenant = getenv("LARAVEL_NACOS_TENANT");

        // 配置全局快照路径
        $isWatch = getenv("LARAVEL_NACOS_IS_WATCH") ?: true;

        $host = getenv("LARAVEL_NACOS_HOST");
        $port = getenv("LARAVEL_NACOS_PORT");

        $nacos = (new Nacos(
            "${host}:${port}",
            $hasListenCommon ? static::PHP_COMMON_PREFIX . $type : $dataId,
            $groupId,
            $tenant
        ));

        if ($isWatch) {
            ListenerConfigSuccessListener::add(function (?string $config) use ($nacos, $type, $dataId, $groupId, $tenant, $hasListenCommon) {

                if ($hasListenCommon) {
                    $serviceConfig = $this->getServiceConfig($nacos, $dataId);

                    // 更新配置
                    if ($config) {
                        $configList = $serviceConfig . "\n" . $config;
                    } else {
                        $configList = $config;
                    }
                } else {
                    $commonConfig = $this->getCommonConfig($nacos, $type);

                    // 更新配置
                    if ($config) {
                        $configList = $config . "\n" . $commonConfig;
                    } else {
                        $configList = $commonConfig;
                    }
                }

                $this->updateConfig($configList);

                // 保存快照
                LocalConfigInfoProcessor::saveSnapshot($dataId, $groupId, $tenant, $configList);
            });
            $nacos->listener();

        }else{
            // 更新配置
            $configList = $nacos->runOnce();
            $this->updateConfig($configList);

            // 保存快照
            LocalConfigInfoProcessor::saveSnapshot($dataId, $groupId, $tenant, $configList);
        }

    }

    /**
     * 获取公共配置
     * @param Nacos $nacos
     * @param string|null $type
     * @return string|null
     */
    private function getCommonConfig(Nacos $nacos,?string $type): ?string {
        $commonConfig = "";
        if(is_null($type)){
            return $commonConfig;
        }
        $commonConfigDataId = getenv("LARAVEL_NACOS_PHP_COMMON_PREFIX") ?: static::PHP_COMMON_PREFIX . $type;
        if (!empty($commonConfigDataId)) {
            $dataId = $nacos->getDataId();
            $nacos->setDataId($commonConfigDataId);
            $commonConfig = $nacos->runOnce();

            $nacos->setDataId($dataId);
        }
        return $commonConfig;
    }

    /**
     * 获取公共配置
     * @param Nacos $nacos
     * @param string $dataId
     * @return string|null
     */
    private function getServiceConfig(Nacos $nacos, string $dataId): ?string {

        $commonDataId = $nacos->getDataId();
        $nacos->setDataId($dataId);
        $config = $nacos->runOnce();

        $nacos->setDataId($commonDataId);
        return $config;
    }

    /**
     * 更新配置
     * @param string $configList
     * @throws Exception
     */
    private function updateConfig(string $configList) {
        // validate
        if (empty($configList)) {
            throw new Exception("config from nacos is empty");
        }
        file_put_contents($this->configFilePath, $configList);
    }
}