<?php
/**
 * Created by PhpStorm.
 * User: MapleSnow
 * Date: 2022/4/7
 * Time: 11:05
 */

namespace MapleSnow\LoadBalance\Service;

use Illuminate\Support\Facades\Log;
use MapleSnow\LoadBalance\Contract\ILoadBalancer;
use MapleSnow\LoadBalance\Contract\IRule;
use Swoole\Atomic;

class RoundRule implements IRule {

    private $nextServerCyclicCounter;

    public function __construct() {
        $this->nextServerCyclicCounter = new Atomic(0);
    }

    function choose(ILoadBalancer $ILoadBalancer) {
        $server = null;
        $retry = 0;

        while($retry++ < 10) {
            if (is_null($server)) {
                $serverList = $ILoadBalancer->getServerList();

                $nodeCount = count($serverList);

                if ($nodeCount > 0) {
                    $nextServerIndex = $this->getAndIncrementModulo($nodeCount);
                    $server = $serverList[$nextServerIndex];

                    if (is_null($server) || !$server->isActive()) {
                        Log::warning("No available servers from load balance");
                        continue;
                    }

                    return $server;
                }
            }
        }

        if ($retry >= 10) {
            Log::warning("no available servers after 10 tries from load balance");
        }
        return $server;
    }


    private function getAndIncrementModulo(int $module) {
        do{
            $current = $this->nextServerCyclicCounter->get();
            $next = ($current + 1) % $module;
        }while(!$this->nextServerCyclicCounter->cmpset($current, $next));

        return $next;
    }


}