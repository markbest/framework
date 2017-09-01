<?php

namespace Componet\View;

use Component\Helper\Url;

class Cache{
    /**
     * cache file path
     * @var string
     */
    private $cache_path;

    /**
     * cache file time
     * @var int
     */
    private $cache_time;

    /**
     * cache file handle
     * @var
     */
    private $cache_file;

    /**
     * cache file name
     * @var string
     */
    private $cache_file_name;

    /**
     * cache file content
     * @var
     */
    private $cache_file_content;

    /**
     * Cache constructor.
     * @param $file
     */
    public function __construct($file){
        $this->cache_file = $file;
        $this->cache_path = Url::assetCache();
        $this->cache_time = 3600;
        $this->cache_file_name = md5($file);
        $this->checkNeedRefresh();
    }

    /**
     * Get cache content
     * @return string
     */
    public function loadCache(){
        if(!$this->checkExpire()){
            return $this->cache_file_content;
        }else{
            return '';
        }
    }

    /**
     * Check cache is expire or not
     * @return bool
     */
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

    /**
     * Check cache is need refresh or not
     */
    public function checkNeedRefresh()
    {
        $cache_file = $this->cache_path . DIRECTORY_SEPARATOR . $this->cache_file_name;
        if(file_exists($cache_file)){
            if(filemtime($this->cache_file) > filemtime($cache_file)){
                $this->deleteCacheFile();
            }
        }
    }

    /**
     * Generate new cache
     * @param $content
     */
    public function createCache($content){
        $cache_file = $this->cache_path . DIRECTORY_SEPARATOR . $this->cache_file_name;
        file_put_contents($cache_file, $content);
    }

    /**
     * Delete old cache
     */
    public function deleteCacheFile(){
        $cache_file = $this->cache_path . DIRECTORY_SEPARATOR . $this->cache_file_name;
        unlink($cache_file);
    }
}