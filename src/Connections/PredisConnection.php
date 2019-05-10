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
     * 返回字符串
     *
     * @param string $key
     * @return false | string
     */
    public function get($key)
    {
        $result = $this->command('get', [$key]);
        return is_null($result) ? false : $result;
    }

    /**
     * 返回所查询键的值
     *
     * @param array $keys
     * @return array
     */
    public function mget(array $keys)
    {
        return array_map(function($value){
            return is_null($value) ? false : $value;
        }, $this->command('mget', $keys));
    }

    /**
     * @param dynamic $keys
     * @return bool
     */
    public function hexists(...$keys)
    {
        return (bool)$this->command('hexists', $keys);
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
