<?php

namespace Lib\View;

use BadMethodCallException;
use UnexpectedValueException;
use InvalidArgumentException;

use Lib\View\Parser;

class View{
    static $template_path = '/resource/views/';
    public $template_view;
    public $template_data;

    public function __construct($view){
        $this->template_view = $view;
    }

    public static function make($viewName = null){
        if(!$viewName){
            throw new InvalidArgumentException("View name cannot be empty!");
        }else{
            $viewFilePath = self::getFilePath($viewName);
            if(is_file($viewFilePath)){
                return new View($viewFilePath);
            }else{
                throw new UnexpectedValueException("View file does not exist!");
            }
        }
    }

    private static function getFilePath($viewName){
        $file_path = str_replace('.','/',$viewName);
        return BASE_PATH . self::$template_path . $file_path . '.phtml';
    }

    public function with($key, $value = null){
        $this->template_data[$key] = $value;
        return $this;
    }

    public function __call($method, $parameters){
        if(starts_with($method, 'with')){
            return $this->with(snake_case(substr($method, 4)), $parameters[0]);
        }
        throw new BadMethodCallException("Method [$method] does not exist!");
    }

    public function load(){
        $parser = new Parser($this->template_view, $this->template_data);
        $parser->parse();
    }
}