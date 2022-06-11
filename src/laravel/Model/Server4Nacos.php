<?php
/**
 * Created by PhpStorm.
 * User: MapleSnow
 * Date: 2022/4/7
 * Time: 14:38
 */

namespace MapleSnow\LaraNacos\Model;

use MapleSnow\LoadBalance\Model\Server;

class Server4Nacos extends Server {

    private $healthy = false;

    private $enabled = false;

    public function isActive(): bool {
        return $this->healthy && $this->enabled;
    }

    /**
     * @return mixed
     */
    public function getHealthy() {
        return $this->healthy;
    }

    /**
     * @param mixed $healthy
     */
    public function setHealthy($healthy): void {
        $this->healthy = $healthy;
    }

    /**
     * @return mixed
     */
    public function getEnabled() {
        return $this->enabled;
    }

    /**
     * @param mixed $enabled
     */
    public function setEnabled($enabled): void {
        $this->enabled = $enabled;
    }
}