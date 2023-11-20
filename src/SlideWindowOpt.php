<?php

namespace Leychan\RateLimiter;
class SlideWindowOpt {
    public $windowSize;

    public $threshold;

    public $key;
    /**
     * @var mixed
     */
    public $member;

    /**
     * @param mixed $windowSize
     * @return SlideWindowOpt
     */
    public function setWindowSize($windowSize) {
        $this->windowSize = $windowSize;
        return $this;
    }

    /**
     * @param $key
     * @return SlideWindowOpt
     */
    public function setKey($key) {
        $this->key = $key;
        return $this;
    }

    public function setThreshold($threshold) {
        $this->threshold = $threshold;
        return $this;
    }

    public function setMember($member) {
        $this->member = $member;
        return $this;
    }
}