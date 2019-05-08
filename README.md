# redis-client

一个简单的 PHP 连接 Redis 拓展。
 - 支持 Predis
 - 支持 Phpredis
 - 支持配置修改驱动

## 安装

`composer require chuxiangqaz/redis-client`

## 使用
```php
$config = [
    // use php extensions config 'phpredis'
    'client' => 'predis',
    
    'default' => [
        'host'     => '127.0.0.1',
        'port'     => 6379,
        'database' =>  0,
        'password' =>  null,
    ],
];


$redisManager = new \CxRedis\RedisManager($config['client'], $config);
$redisClient = $redisManager->connection();

$redisClient->set('name', 'chuxiang');
echo $redisClient->get('name');
```

## 使用方法

- [可使用的 Redis 方法](https://redis.io/commands)

