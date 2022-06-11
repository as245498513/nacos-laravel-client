<?php
/**
 * Created by PhpStorm.
 * User: MapleSnow
 * Date: 2022/4/7
 * Time: 13:52
 */

namespace MapleSnow\LoadBalance\Contract;

use MapleSnow\LoadBalance\Model\Server;

interface ILoadBalancer {

    /**
     * @return Server[]
     */
    function getServerList();
}