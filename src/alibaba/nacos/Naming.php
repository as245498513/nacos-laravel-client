<?php


namespace alibaba\nacos;


use ReflectionException;
use alibaba\nacos\model\Instance;

/**
 * Class Naming
 * @package alibaba\nacos
 */
class Naming
{
    /**
     * @param $serviceName
     * @param $ip
     * @param $port
     * @param string $namespaceId
     * @param string $weight
     * @param string $ephemeral
     * @return Naming
     */
    public static function init($serviceName, $ip, $port, $namespaceId = "", $weight = "", $ephemeral = "true")
    {
        static $client;
        if ($client == null) {
            NamingConfig::setServiceName($serviceName);
            NamingConfig::setIp($ip);
            NamingConfig::setPort($port);
            NamingConfig::setNamespaceId($namespaceId);
            NamingConfig::setWeight($weight);
            NamingConfig::setEphemeral($ephemeral);

            $client = new self();
        }
        return $client;
    }

    /**
     * @param string $enable
     * @param string $healthy
     * @param string $clusterName
     * @param string $metadata
     * @return bool
     * @throws ReflectionException
     * @throws exception\RequestUriRequiredException
     * @throws exception\RequestVerbRequiredException
     * @throws exception\ResponseCodeErrorException
     */
    public function register($enable = "true", $healthy = "true", $clusterName = "", $metadata = "{}")
    {
        return NamingClient::register(
            NamingConfig::getServiceName(),
            NamingConfig::getIp(),
            NamingConfig::getPort(),
            NamingConfig::getWeight(),
            NamingConfig::getNamespaceId(),
            $enable,
            $healthy,
            $clusterName,
            $metadata
        );
    }

    /**
     * @param string $namespaceId
     * @param string $clusterName
     * @return bool
     * @throws ReflectionException
     * @throws exception\RequestUriRequiredException
     * @throws exception\RequestVerbRequiredException
     * @throws exception\ResponseCodeErrorException
     */
    public function delete($namespaceId = "", $clusterName = "")
    {
        return NamingClient::delete(
            NamingConfig::getServiceName(),
            NamingConfig::getIp(),
            NamingConfig::getPort(),
            $namespaceId,
            $clusterName
        );
    }

    /**
     * @param string $clusterName
     * @param string $metadata
     * @return bool
     * @throws ReflectionException
     * @throws exception\RequestUriRequiredException
     * @throws exception\RequestVerbRequiredException
     * @throws exception\ResponseCodeErrorException
     */
    public function update($clusterName = "", $metadata = "{}")
    {
        return NamingClient::update(
            NamingConfig::getServiceName(),
            NamingConfig::getIp(),
            NamingConfig::getPort(),
            NamingConfig::getWeight(),
            NamingConfig::getNamespaceId(),
            $clusterName,
            $metadata
        );
    }

    /**
     * @param string $healthyOnly
     * @param string $clusters
     * @return model\InstanceList
     * @throws ReflectionException
     * @throws exception\RequestUriRequiredException
     * @throws exception\RequestVerbRequiredException
     * @throws exception\ResponseCodeErrorException
     */
    public function listInstances($healthyOnly = "true", $clusters = "")
    {
        return NamingClient::listInstances(
            NamingConfig::getServiceName(),
            $healthyOnly,
            NamingConfig::getNamespaceId(),
            $clusters
        );
    }

    /**
     * @return model\Beat
     * @throws ReflectionException
     * @throws exception\RequestUriRequiredException
     * @throws exception\RequestVerbRequiredException
     * @throws exception\ResponseCodeErrorException
     */
    public function beat()
    {
        return NamingClient::beat(
            NamingConfig::getServiceName(),
            NamingConfig::getNamespaceId(),
            json_encode([
                "ip"    => NamingConfig::getIp(),
                "port"  => NamingConfig::getPort(),
                "serviceName" => NamingConfig::getServiceName(),
                "weight" => NamingConfig::getWeight()
            ])
        );
    }

    /**
     * @param string $healthyOnly
     * @param string $ephemeral
     * @param string $clusters
     * @return Instance
     * @throws ReflectionException
     * @throws exception\RequestUriRequiredException
     * @throws exception\RequestVerbRequiredException
     * @throws exception\ResponseCodeErrorException
     */
    public function get($healthyOnly = "true", $ephemeral = "true",$clusters = "")
    {
        return NamingClient::get(
            NamingConfig::getServiceName(),
            NamingConfig::getIp(),
            NamingConfig::getPort(),
            $healthyOnly,
            $ephemeral,
            NamingConfig::getNamespaceId(),
            $clusters
        );
    }

}