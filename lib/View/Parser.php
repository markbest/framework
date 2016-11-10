<?php

namespace Lib\View;

use Lib\Helper\Url;
use Lib\View\Cache;

class Parser{
    private $url;
    private $file;
    private $parameter;
    private $cache;

    public function __construct($file, $parameters)
    {
        $this->url = new Url;
        $this->file = $file;
        $this->parameter = $parameters;
        $this->cache = new Cache($this->file);
    }

    public function parse()
    {
        if(count($this->parameter)){
            extract($this->parameter);
        }

        if($content = $this->cache->loadCache()){
            echo eval('?>' .$content);
        }else{
            $patterns = array();
            $replace = array();
            if(file_exists($this->file)){
                $keys = array(
                    '{if %%}' => '<?php if (\1): ?>',
                    '{elseif %%}' => '<?php ; elseif (\1): ?>',
                    '{for %%}' => '<?php for (\1): ?>',
                    '{foreach %%}' => '<?php foreach (\1): ?>',
                    '{while %%}' => '<?php while (\1): ?>',
                    '{/if}' => '<?php endif; ?>',
                    '{/for}' => '<?php endfor; ?>',
                    '{/foreach}' => '<?php endforeach; ?>',
                    '{/while}' => '<?php endwhile; ?>',
                    '{else}' => '<?php ; else: ?>',
                    '{continue}' => '<?php continue; ?>',
                    '{break}' => '<?php break; ?>',
                    '{$%% = %%}' => '<?php $\1 = \2; ?>',
                    '{$%%++}' => '<?php $\1++; ?>',
                    '{$%%--}' => '<?php $\1--; ?>',
                    '{$%%}' => '<?php echo $\1; ?>',
                    '{comment}' => '<?php /*',
                    '{/comment}' => '*/ ?>',
                    '{/*}' => '<?php /*',
                    '{*/}' => '*/ ?>',
                    '{base_path}' => '<?php echo $this->url->asset();?>',
                    '{static_path}' => '<?php echo $this->url->assetStatic();?>'
                );

                foreach ($keys as $key => $val) {
                    $patterns[] = '#' . str_replace('%%', '(.+)', preg_quote($key, '#')) . '#U';
                    $replace[] = $val;
                }
                $content = preg_replace($patterns, $replace, file_get_contents($this->file));
                $this->cache->createCache($content);
                echo eval('?>' .$content);
            }
        }
    }
}