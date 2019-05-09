<?php
/**
 * Created by PhpStorm.
 * User: ChuXiang
 * Date: 2019/5/9
 * Time: 9:50
 */

namespace CxRedis;


class RedisFacade
{
    /**
     * @var null | \CxRedis\RedisManager
     */
    protected static $redisManager = null;

    /**
     * 注册 Redis 客户端
     *
     * @param array $config
     * @return \CxRedis\RedisManager
     * @throws \Exception
     */
    public function register(array $config)
    {
        if (self::$redisManager !== null) {
            return self::$redisManager;
        }

        $driver = isset($config['client']) ? $config['client'] : 'predis';
        unset($config['client']);
        $manager = new RedisManager($driver, $config);
        $manager->connection();

        return self::$redisManager = $manager;
    }

    /**
     * 获取 Redis 管理者
     *
     * @return null | \CxRedis\RedisManager
     */
    public function getRedisManager()
    {
        return self::$redisManager;
    }

    /**
     * 将请求转发给 redisManager
     *
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws \Exception
     */
    public static function __callStatic($name, $arguments)
    {
        return self::$redisManager->{$name}(...$arguments);
    }
}