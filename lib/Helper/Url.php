<?php

namespace Lib\Helper;

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
        return $this->asset() . '/resource/static';
    }

    /**
     * Get assign cache dir
     * @return string
     */
    public static function assetCache(){
        return BASE_PATH . '/resource/cache';
    }
}