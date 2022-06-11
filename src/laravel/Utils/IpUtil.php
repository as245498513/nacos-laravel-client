<?php
/**
 * Created by PhpStorm.
 * User: MapleSnow
 * Date: 2022/3/29
 * Time: 16:44
 */

namespace MapleSnow\LaraNacos\Utils;


class IpUtil {

    public static function getServerIp(){
        return system("cat /etc/hosts | grep `hostname` | awk '{print $1}'") ?: "127.0.0.1";
    }
}