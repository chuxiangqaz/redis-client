<?php
/**
 * Created by PhpStorm.
 * User: ChuXiang
 * Date: 2019/5/10
 * Time: 15:51
 */

namespace CxRedis\Connections;


use CxRedis\Contracts\ConnectionContract;
use Predis\Client;

class PredisConnection extends BaseConnection implements ConnectionContract
{
    /**
     * @param \Predis\Client $client
     */
    public function __construct(Client $client)
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
