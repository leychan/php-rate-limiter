<?php

namespace Leychan\RateLimiter;

class RedisClientOpt {
    public $host;

    public $port;

    public $password;

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    public function setPort($port) {
        $this->port = $port;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }
}