<?php

namespace Lib\View;

use Lib\Helper\Url;

class Cache{
    private $cache_path;
    private $cache_time;
    private $cache_file_name;
    private $cache_file_content;

    public function __construct($file){
        $this->cache_path = Url::assetCache();
        $this->cache_time = 3600;
        $this->cache_file_name = md5($file);
    }

    public function loadCache(){
        if(!$this->checkExpire()){
            return $this->cache_file_content;
        }else{
            return '';
        }
    }

    public function checkExpire(){
        $cache_file = $this->cache_path . DIRECTORY_SEPARATOR . $this->cache_file_name;
        if(file_exists($cache_file)){
            $this->cache_file_content = file_get_contents($cache_file);
            if(strtotime(date('Y-m-d h:i:s',time())) - filemtime($cache_file) <= $this->cache_time){
                return false;
            }else{
                $this->deleteCacheFile();
                return true;
            }
        }else{
            return true;
        }
    }

    public function createCache($content){
        $cache_file = $this->cache_path . DIRECTORY_SEPARATOR . $this->cache_file_name;
        file_put_contents($cache_file, $content);
    }

    public function deleteCacheFile(){
        $cache_file = $this->cache_path . DIRECTORY_SEPARATOR . $this->cache_file_name;
        unlink($cache_file);
    }
}