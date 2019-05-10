<?php
/**
 * Created by PhpStorm.
 * User: ChuXiang
 * Date: 2019/5/5
 * Time: 11:46
 */

namespace CxRedis\Connectors;

use CxRedis\Connections\PhpRedisConnection;
use CxRedis\Contracts\ConnectorContract;
use Redis;

class PhpConnectorConnector implements ConnectorContract
{

    /**
     * 连接 Redis 客户端
     *
     * @param array $config
     * @param array $options
     * @return \CxRedis\Connections\PhpRedisConnection
     */
    public function connect(array $config, array $options)
    {
        $client = $this->createClient($config);
        return new PhpRedisConnection($client);
    }

    /**
     * 创建客户端,并进行舒适和设置
     *
     * @param array $config
     * @return \Redis
     */
    private function createClient(array $config)
    {
        $client = new Redis();

        $this->establishConnection($client, $config);

        if (! empty($config['password'])) {
            $client->auth($config['password']);
        }

        if (! empty($config['database'])) {
            $client->select($config['database']);
        }

        if (! empty($config['prefix'])) {
            $client->setOption(Redis::OPT_PREFIX, $config['prefix']);
        }

        if (! empty($config['read_timeout'])) {
            $client->setOption(Redis::OPT_READ_TIMEOUT, $config['read_timeout']);
        }

        return $client;
    }

    /**
     * 建立连接
     *
     * @param \Redis $client
     * @param array $config
     * @return  void
     */
    private function establishConnection($client, $config)
    {
        $persistent = $config['persistent'] ?? false;

        $parameters = [
            $config['host'],
            $config['port'],
            $config['timeout'] ?? 0.0,
            $persistent ? ($config['persistent_id'] ?? null) : null,
            $config['retry_interval'] ?? 0,
        ];

        if (version_compare(phpversion('redis'), '3.1.3', '>=')) {
            $parameters[] = $config['read_timeout'] ?? 0.0;
        }

        $client->{($persistent ? 'pconnect' : 'connect')}(...$parameters);
    }
}