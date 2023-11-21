<?php
namespace Leychan\RateLimiter;

use Redis;
use RedisException;

// 滑动窗口限流器
class RateLimiter {
    /**
     * @var SlideWindowOpt $slideWindowOpt 滑动窗口设置
     */
    private $slideWindowOpt;

    /**
     * @var RedisClientOpt $redisClientOpt redis client设置
     */
    private $redisClientOpt;

    /**
     * @var Redis $redisClient
     */
    private $redisClient;
    /**
     * @var mixed
     */
    private $luaScript;

    /**
     * @param RedisClientOpt $redisClientOpt
     * @param SlideWindowOpt $slideWindowOpt
     * @throws RedisException
     * @desc 初始化RateLimiter
     */
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

    /**
     * @return mixed
     * @throws RedisException
     * @desc 检查是否超过阈值
     */
    public function check() {
        return $this->redisClient->eval($this->luaScript, [
            $this->slideWindowOpt->key,
            $this->slideWindowOpt->windowSize,
            $this->slideWindowOpt->threshold,
            (int)microtime(true),
            $this->slideWindowOpt->uniqueId,
        ], 1);
    }
}


