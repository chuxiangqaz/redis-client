<?php
/**
 * Created by PhpStorm.
 * User: ChuXiang
 * Date: 2019/5/5
 * Time: 11:39
 */

namespace CxRedis\Contracts;


interface ConnectorContract
{
    /**
     * 创建于客户端的连接
     *
     * @param array $config
     * @param array $options
     * @return object
     */
    public function connect(array $config, array $options);
}