<?php
/**
 * Created by PhpStorm.
 * User: ChuXiang
 * Date: 2019/5/10
 * Time: 15:52
 */

namespace CxRedis\Contracts;


interface ConnectionContract
{
    /**
     * 运行命令在 Redis Server 上
     *
     * @param string $method
     * @param array $params
     * @return mixed
     */
    public function command($method, array $params = []);
}
