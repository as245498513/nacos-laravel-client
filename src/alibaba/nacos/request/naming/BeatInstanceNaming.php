<?php

namespace alibaba\nacos\request\naming;

class BeatInstanceNaming extends NamingRequest
{
    protected $uri = "/nacos/v1/ns/instance/beat";
    protected $verb = "PUT";

    /**
     * 服务名
     *
     * @var
     */
    private $serviceName;

    private $namespaceId;

    /**
     * 实例心跳内容
     *
     * @var
     */
    private $beat;


    /**
     * @return mixed
     */
    public function getServiceName()
    {
        return $this->serviceName;
    }

    /**
     * @param mixed $serviceName
     */
    public function setServiceName($serviceName)
    {
        $this->serviceName = $serviceName;
    }

    /**
     * @return mixed
     */
    public function getNamespaceId() {
        return $this->namespaceId;
    }

    /**
     * @param mixed $namespaceId
     */
    public function setNamespaceId($namespaceId): void {
        $this->namespaceId = $namespaceId;
    }

    /**
     * @return mixed
     */
    public function getBeat()
    {
        return $this->beat;
    }

    /**
     * @param mixed $beat
     */
    public function setBeat($beat)
    {
        $this->beat = $beat;
    }
}
