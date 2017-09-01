<?php

namespace Component\Helper;

class Url{
    /**
     * Get assign url
     * @return string
     */
    public function asset(){
        return sprintf(
            "%s://%s%s",
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME'],
            $_SERVER['REQUEST_URI']
        );
    }

    /**
     * Get assign static dir
     * @return string
     */
    public function assetStatic(){
        return $this->asset() . DIRECTORY_SEPARATOR . 'resource' . DIRECTORY_SEPARATOR . 'static';
    }

    /**
     * Get assign cache dir
     * @return string
     */
    public static function assetCache(){
        return BASE_PATH . DIRECTORY_SEPARATOR . 'resource' . DIRECTORY_SEPARATOR . 'cache';
    }
}