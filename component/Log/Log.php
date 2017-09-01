<?php

namespace Component\Log;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log{
    /**
     * @var Logger
     */
    private $handle;

    /**
     * @var StreamHandler
     */
    private $stream;

    /**
     * Log constructor.
     */
    public function __construct(){
        $this->handle = new Logger('app');
        $this->initLogHandle();
    }

    /**
     * Init Log handle
     */
    protected function initLogHandle(){
        $log_file = BASE_PATH . '/storage/logs/' . date('Ymd', time()) . '.log';
        $this->stream = new StreamHandler($log_file);
    }

    /**
     * Log info
     * @param $message
     * @param array $data
     */
    public function info($message, $data = []){
        $this->stream->setLevel('INFO');
        $this->handle->pushHandler($this->stream);
        $this->handle->info($message, $data);
    }

    /**
     * Log debug
     * @param $message
     * @param array $data
     */
    public function debug($message, $data = []){
        $this->stream->setLevel('DEBUG');
        $this->handle->pushHandler($this->stream);
        $this->handle->debug($message, $data);
    }

    /**
     * Log debug
     * @param $message
     * @param array $data
     */
    public function notice($message, $data = []){
        $this->stream->setLevel('NOTICE');
        $this->handle->pushHandler($this->stream);
        $this->handle->notice($message, $data);
    }

    /**
     * Log warning
     * @param $message
     * @param array $data
     */
    public function warning($message, $data = []){
        $this->stream->setLevel('WARNING');
        $this->handle->pushHandler($this->stream);
        $this->handle->warning($message, $data);
    }

    /**
     * Log error
     * @param $message
     * @param array $data
     */
    public function error($message, $data = []){
        $this->stream->setLevel('ERROR');
        $this->handle->pushHandler($this->stream);
        $this->handle->error($message, $data);
    }
}