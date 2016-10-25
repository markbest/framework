<?php
namespace Lib\View;

use BadMethodCallException;
use UnexpectedValueException;
use InvalidArgumentException;

use Lib\View\Parser;

class View{
    const VIEW_BASH_PATH = '/resource/views/';
    public $view;
    public $data;

    public function __construct($view){
        $this->view = $view;
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
        return BASE_PATH . self::VIEW_BASH_PATH . $file_path . '.phtml';
    }

    public function with($key, $value = null){
        $this->data[$key] = $value;
        return $this;
    }

    public function __call($method, $parameters){
        if(starts_with($method, 'with')){
            return $this->with(snake_case(substr($method, 4)), $parameters[0]);
        }
        throw new BadMethodCallException("Method [$method] does not exist!");
    }

    public function load(){
        Parser::parse($this->data,$this->view);
    }
}