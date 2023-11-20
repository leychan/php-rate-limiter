<?php

namespace Leychan\RateLimiter;


class Context {
    private $clientIp;

    private $uri;

    public function __construct() {
        $this->init();
    }

    public function getClientIp() {
        return $this->clientIp;
    }

    /**
     * @return string
     */
    public function getUri() {
        return $this->uri;
    }

    public function init() {
        $this->clientIp = $this->getClientRealIp();
        $this->uri = $this->getRequestUri();
    }

    /**
     * @return mixed|string
     * @author lei
     * @desc 获取客户端ip
     */
    public function getClientRealIp() {
        if ($_SERVER['HTTP_CLIENT_IP']) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }
        if ($_SERVER['HTTP_X_FORWARDED_FOR']) {
            $ipArr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            return $ipArr[0];
        }

        return $_SERVER['REMOTE_ADDR'];
    }

    public function getRequestUri() {
        return $_SERVER['REQUEST_URI'];
    }
}