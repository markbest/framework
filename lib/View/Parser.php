<?php
namespace Lib\View;

class Parser{
    public function __construct(){

    }

    public static function parse($parameters, $file){
        if(count($parameters)){
            extract($parameters);
        }

        if(file_exists($file)){
            require $file;
        }
    }
}