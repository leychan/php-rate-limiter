<?php

namespace Leychan\RateLimiter;

class RedisClientOpt {
    // redis host
    public $host;

    // redis port
    public $port;

    // redis password
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