<?php
/**
 * Created by PhpStorm.
 * User: ChuXiang
 * Date: 2019/5/10
 * Time: 15:50
 */

namespace CxRedis\Connections;


use CxRedis\Contracts\ConnectionContract;
use Redis;

class PhpRedisConnection extends BaseConnection implements ConnectionContract
{
    /**
     * @param \Redis $client
     */
    public function __construct(Redis $client)
    {
        $this->client = $client;
    }

    /**
     * 运行命令在 Redis Server 上
     *
     * @param string $method
     * @param array $params
     * @return mixed
     */
    public function command($method, array $params = [])
    {
        return parent::command($method, $params);
    }
}
