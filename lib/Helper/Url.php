<?php

namespace Lib\Helper;

class Url{
    public function asset(){
        return sprintf(
            "%s://%s%s",
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME'],
            $_SERVER['REQUEST_URI']
        );
    }

    public function assetStatic(){
        return $this->asset() . DIRECTORY_SEPARATOR . 'resource' . DIRECTORY_SEPARATOR . 'static';
    }

    public static function assetCache(){
        return BASE_PATH . DIRECTORY_SEPARATOR . 'resource' . DIRECTORY_SEPARATOR . 'cache';
    }
}