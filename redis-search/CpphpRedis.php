<?php
/**
 * Created by PhpStorm.
 * User: liangzhi
 * Date: 16-11-21
 * Time: 下午2:16
 */

namespace Cpphp;


class CpphpRedis
{
    //Redis Object
    protected  $redis;

    const REDISDB = '127.0.0.1';
    const REDISPORT = 6379;
    public function __construct()
    {
        $this->redis = new \Redis();

        $this->redis->connect(self::REDISDB, self::REDISPORT);
    }

//    public function
}