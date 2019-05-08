<?php
/**
 * Created by PhpStorm.
 * User: ChuXiang
 * Date: 2019/5/5
 * Time: 11:37
 */

namespace CxRedis\Connectors;

use Predis\Client;

class Predis extends BaseRedis implements RedisContract
{
    /**
     * 连接 Redis 客户端
     *
     * @param array $config
     * @param array $options
     * @return \Predis\Client
     */
    public function connect(array $config, array $options)
    {
        $mergeOptions = [];
        if (isset($config['options'])) {
            $config['options'] = $mergeOptions;
            unset($config['options']);
        }

        $formattedOptions = array_merge(
            ['timeout' => 10.0], $options, $mergeOptions
        );

        return $this->client = new Client($config, $formattedOptions);
    }
}
