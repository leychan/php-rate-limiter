# php-rate-limiter

php-rate-limiter is a rate limiter powered by php and redis

# installation

```bash 
composer require leychan/php-rate-limiter
```

# usage

```php
require_once __DIR__ . '/../vendor/autoload.php';

use Leychan\RateLimiter\RateLimiter;
use Leychan\RateLimiter\RedisClientOpt;
use Leychan\RateLimiter\SlideWindowOpt;

$redisClientOpt = (new RedisClientOpt())->setHost('127.0.0.1')->setPort(6379);
// 设置窗口大小以及阈值,key为redis的key,统计窗口内的请求数
// 每 1000000 ms 内允许的请求数为 5
$slideWindowOpt = (new SlideWindowOpt())->setWindowSize(100000)->setThreshold(5)->setKey('test2222');

for ($i = 0; $i < 20; $i++) {
    $rateLimiter = new RateLimiter(
        $redisClientOpt,
        $slideWindowOpt->setUniqueId($i)
    );

    var_dump($rateLimiter->check());
}
```