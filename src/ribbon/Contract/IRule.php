<?php
/**
 * Created by PhpStorm.
 * User: MapleSnow
 * Date: 2022/4/7
 * Time: 11:01
 */

namespace MapleSnow\LoadBalance\Contract;

interface IRule {

    function choose(ILoadBalancer $ILoadBalancer);
}