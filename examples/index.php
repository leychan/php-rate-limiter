<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Leychan\RateLimiter\RateLimiter;
use Leychan\RateLimiter\RedisClientOpt;
use Leychan\RateLimiter\SlideWindowOpt;

$redisClientOpt = (new RedisClientOpt())->setHost('127.0.0.1')->setPort(6379);
$slideWindowOpt = (new SlideWindowOpt())->setWindowSize(100000)->setThreshold(5)->setKey('test2222');

for ($i = 0; $i < 20; $i++) {
    $rateLimiter = new RateLimiter(
        $redisClientOpt,
        $slideWindowOpt->setMember(mt_rand(0, 9999))
    );

    var_dump($rateLimiter->check());
}

