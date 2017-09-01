<?php

namespace Componet\View;

use BadMethodCallException;
use UnexpectedValueException;
use InvalidArgumentException;

use Componet\View\Parser;

class View{
    /**
     * @var string
     */
    static $template_path = DIRECTORY_SEPARATOR . 'resource' . DIRECTORY_SEPARATOR .'views' . DIRECTORY_SEPARATOR;

    /**
     * @var
     */
    public $template_view;

    /**
     * @var
     */
    public $template_data;

    /**
     * View constructor.
     * @param $view
     */
    public function __construct($view){
        $this->template_view = $view;
    }

    /**
     * @param null $viewName
     * @return View
     */
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

    /**
     * @param $viewName
     * @return string
     */
    private static function getFilePath($viewName){
        $file_path = str_replace('.', DIRECTORY_SEPARATOR, $viewName);
        return BASE_PATH . self::$template_path . $file_path . '.phtml';
    }

    /**
     * @param $key
     * @param null $value
     * @return $this
     */
    public function with($key, $value = null){
        $this->template_data[$key] = $value;
        return $this;
    }

    /**
     * @param $method
     * @param $parameters
     * @return View
     */
    public function __call($method, $parameters){
        if(starts_with($method, 'with')){
            return $this->with(snake_case(substr($method, 4)), $parameters[0]);
        }
        throw new BadMethodCallException("Method [$method] does not exist!");
    }

    /**
     *
     */
    public function load(){
        $parser = new Parser($this->template_view, $this->template_data);
        $parser->parse();
    }
}