<?php


namespace alibaba\nacos;


use alibaba\nacos\util\LogUtil;

/**
 * Class Nacos
 *
 * @author suxiaolin
 * @package alibaba\nacos
 */
class Nacos
{
    private static $clientClass;

    private $host;

    private $dataId;

    private $groupId;

    private $tenant;

    public function __construct($host, $dataId, $groupId, $tenant)
    {
        NacosConfig::setHost($host);
        $this->dataId = $dataId;
        $this->groupId = $groupId;
        $this->tenant = $tenant;

        if (getenv("NACOS_ENV") == "local") {
            LogUtil::info("nacos run in dummy mode");
            self::$clientClass = DummyNacosClient::class;
        } else {
            self::$clientClass = NacosClient::class;
        }

    }

    public function runOnce()
    {
        return call_user_func_array([self::$clientClass, "get"], [$this->dataId, $this->groupId, $this->tenant]);
    }

    public function listener()
    {
        call_user_func_array([self::$clientClass, "listener"], [$this->dataId, $this->groupId, $this->tenant]);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHost() {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host): void {
        $this->host = $host;
    }

    /**
     * @return mixed
     */
    public function getDataId() {
        return $this->dataId;
    }

    /**
     * @param mixed $dataId
     */
    public function setDataId($dataId): void {
        $this->dataId = $dataId;
    }

    /**
     * @return mixed
     */
    public function getGroupId() {
        return $this->groupId;
    }

    /**
     * @param mixed $groupId
     */
    public function setGroupId($groupId): void {
        $this->groupId = $groupId;
    }

    /**
     * @return mixed
     */
    public function getTenant() {
        return $this->tenant;
    }

    /**
     * @param mixed $tenant
     */
    public function setTenant($tenant): void {
        $this->tenant = $tenant;
    }

}