<?php
/**
 * Created by PhpStorm.
 * User: MapleSnow
 * Date: 2022/4/7
 * Time: 13:57
 */

namespace MapleSnow\LoadBalance\Model;


class Server {

    private $ip;

    private $port;

    /**
     * @return mixed
     */
    public function getIp() {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     */
    public function setIp($ip): void {
        $this->ip = $ip;
    }

    /**
     * @return mixed
     */
    public function getPort() {
        return $this->port;
    }

    /**
     * @param mixed $port
     */
    public function setPort($port): void {
        $this->port = $port;
    }

    public function isActive() : bool{
        return true;
    }
}