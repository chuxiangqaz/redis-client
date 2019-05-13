# redis-client

一个简单的 PHP 连接 Redis 拓展。
> **原则：让其它驱动以 PhpRedis 驱动为模板！让原本使用 PhpRedis 客户端代码可以无缝切换到其他驱动。**

 - 支持 Predis
 - 支持 PhpRedis
 - 支持配置修改驱动

## 安装

> 建议选择 PHP 7.0 以上版本  

`composer require chuxiangqaz/redis-client`

## 使用

### 使用 RedisManger
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

$redisClient->set('name', 'test');
echo $redisClient->get('name');
```

### 使用 门面(RedisFacade)
```php
use CxRedis\RedisFacade;

$config = [
    'client' => 'predis',
    'default' => [
        'host'     => '127.0.0.1',
        'port'     => 6379,
        'database' =>  0,
        'password' =>  null,
    ],
];

$facade = new RedisFacade();
$facade->register($config);

RedisFacade::set('name', 'test');
echo RedisFacade::get('name');

```

## 使用方法

- [可使用的 Redis 方法](https://redis.io/commands)
