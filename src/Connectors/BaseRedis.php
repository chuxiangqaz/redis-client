<?php
/**
 * Created by PhpStorm.
 * User: ChuXiang
 * Date: 2019/5/5
 * Time: 14:36
 */

namespace CxRedis\Connectors;


class BaseRedis
{
    /**
     * Redis 连接客户端
     *
     * @var null|\Redis|\Predis\Client
     */
    protected $client = null;


    /**
     * 将方法传递到 Redis 客户端请求
     *
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this->client->{$name}(...$arguments);
    }

}