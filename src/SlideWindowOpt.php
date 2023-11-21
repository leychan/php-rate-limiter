<?php

namespace Leychan\RateLimiter;

// 滑动窗口设置
class SlideWindowOpt {
    // 滑动窗口大小, 时间段, 毫秒
    public $windowSize;

    // 阈值
    public $threshold;

    //redis key
    public $key;

    // unique id
    public $uniqueId;

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

    /**
     * @param $threshold
     * @return $this
     * @author lei
     * @desc
     */
    public function setThreshold($threshold) {
        $this->threshold = $threshold;
        return $this;
    }


    /**
     * @param mixed $uniqueId
     * @return SlideWindowOpt
     */
    public function setUniqueId($uniqueId)
    {
        $this->uniqueId = $uniqueId;
        return $this;
    }
}