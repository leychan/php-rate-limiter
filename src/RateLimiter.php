<?php
namespace Leychan\RateLimiter;

use Redis;
use RedisException;

//
class RateLimiter {
    /**
     * @var SlideWindowOpt
     */
    private $slideWindowOpt;

    private $redisClientOpt;
    private $redisClient;
    /**
     * @var mixed
     */
    private $luaScript;

    public function __construct(RedisClientOpt $redisClientOpt, SlideWindowOpt $slideWindowOpt) {
        $this->slideWindowOpt = $slideWindowOpt;
        $this->redisClientOpt = $redisClientOpt;
        $this->luaScript = file_get_contents(__DIR__ . '/slide_window.lua');
        $this->initRedisClient();
    }

    /**
     * @throws RedisException
     */
    public function initRedisClient() {
        $this->redisClient = new Redis();

        $this->redisClient->connect($this->redisClientOpt->host, $this->redisClientOpt->port);
        if ($this->redisClientOpt->password) {
            $this->redisClient->auth($this->redisClientOpt->password);
        }
    }


    public function check() {
        return $this->redisClient->eval($this->luaScript, [
            $this->slideWindowOpt->key,
            $this->slideWindowOpt->windowSize,
            $this->slideWindowOpt->threshold,
            (int)microtime(true),
            $this->slideWindowOpt->member,
        ], 1);
    }
}


