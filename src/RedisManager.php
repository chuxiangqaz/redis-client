<?php
/**
 * Created by PhpStorm.
 * User: ChuXiang
 * Date: 2019/5/5
 * Time: 15:20
 */

namespace CxRedis;


use \Exception;

class RedisManager
{
    /**
     * Redis 驱动
     *
     * @var string
     */
    protected $driver;

    /**
     * Redis 连接配置
     *
     * @var array
     */
    protected $config;

    /**
     * Redis 所有连接
     *
     * @var array
     */
    protected $connections;

    /**
     * RedisManager constructor.
     *
     * @param string $driver
     * @param array $config
     */
    public function __construct($driver, array $config)
    {
        $this->driver = $driver;
        $this->config = $config;
    }

    /**
     * 按名称获取 Redis 连接
     *
     * @param null $name
     * @return \Predis\Client|\Redis
     * @throws Exception
     */
    public function connection($name = null)
    {
        $name = $name ?: 'default';

        if (isset($this->connections[$name])) {
            return $this->connections[$name];
        }

        return $this->connections[$name] = $this->resolve($name);
    }

    /**
     * 按名称解析给定的连接。
     *
     * @param string|null $name
     * @return null|\Redis|\Predis\Client
     * @throws Exception
     */
    public function resolve($name)
    {
        $name = $name ?: 'default';

        $options = isset($this->config['options']) ? $this->config['options'] : [];

        if (isset($this->config[$name])) {
            return $this->connector()->connect($this->config[$name], $options);
        }

        throw new Exception('Redis connection [{$name}] not configured.');
    }

    /**
     * 获取连接客户端
     *
     * @return Connectors\PhpRedis|Connectors\Predis
     * @throws Exception
     */
    protected function connector()
    {
        switch ($this->driver) {
            case 'predis':
                return new Connectors\Predis();
            case 'phpredis':
                return new Connectors\PhpRedis();
        }

        throw new Exception('Redis driver [{$this->driver}] not use!');
    }

    /**
     * 获取 Redis 所有链接
     *
     * @return array
     */
    public function connections()
    {
        return $this->connections;
    }

    /**
     * 将方法传递到默认的 Redis 连接。
     *
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws Exception
     */
    public function __call($name, $arguments)
    {
        return $this->connection()->{$name}(...$arguments);
    }
}
