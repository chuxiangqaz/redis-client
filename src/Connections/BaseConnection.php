<?php
/**
 * Created by PhpStorm.
 * User: ChuXiang
 * Date: 2019/5/10
 * Time: 16:08
 */

namespace CxRedis\Connections;


abstract class BaseConnection
{
    /**
     * @var \Redis|\Predis\Client
     */
    protected $client;

    /**
     * @return \Redis|\Predis\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     *
     * 运行命令在 Redis Server 上
     *
     * @param string $method
     * @param array $params
     * @return mixed
     */
    public function command($method, array $params = [])
    {
        $this->client->lPush('chuxiang_command', json_encode(compact('method', 'params')));
        return $this->client->{$method}(...$params);
    }

    /**
     * 将请求转发给 Redis Server 执行
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this->command($name, $arguments);
    }
}
