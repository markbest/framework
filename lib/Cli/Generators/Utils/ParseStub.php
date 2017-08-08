<?php

namespace Lib\Cli\Generators\Utils;

class ParseStub
{
    /**
     * Stub file dir
     * @var string
     */
    private $dir = 'lib/Cli/Generators/Stubs';

    /**
     * Stub file name
     * @var
     */
    private $name;

    /**
     * Target file dir
     * @var string
     */
    private $target_dir;

    /**
     * Target file name
     * @var
     */
    private $target_name;

    /**
     * Target file suffix
     * @var
     */
    private $target_suffix;

    /**
     * Parse argument
     * @var
     */
    private $argument;

    /**
     * Generator file class name
     * @var
     */
    private $class_name;

    /**
     * Generator file class namespace
     * @var
     */
    private $class_namespace;

    /**
     * ParseStub constructor.
     */
    public function __construct($type, $argument){
        switch($type){
            case 'model':
                $this->name = 'model.stub';
                $this->class_namespace = 'App\Models';
                $this->target_dir = 'app\Models';
                $this->target_suffix = '';
                break;
            case 'controller':
                $this->name = 'controller.stub';
                $this->class_namespace = 'App\Controllers';
                $this->target_dir = 'app\Controllers';
                $this->target_suffix = 'Controller';
                break;
            case 'command':
                $this->name = 'command.stub';
                $this->class_namespace = 'App\Console\Commands';
                $this->target_dir = 'app\Console\Commands';
                $this->target_suffix = 'Command';
                break;
            default:
                break;
        }
        $this->argument = $argument;
    }

    /**
     * Parse command arguments
     */
    public function parseArgument(){
        if($this->argument){
            if(strpos($this->argument, '\\') === false){
                $this->class_name = ucfirst($this->argument);
                $this->target_name = $this->target_dir . '\\' . $this->class_name;
            }else{
                $argument_arr = explode('\\', $this->argument);
                $this->class_name = ucfirst(end($argument_arr));
                $this->target_name = $this->target_dir . '\\';
                foreach($argument_arr as $k => $arg){
                    if($k != count($argument_arr)){
                        $this->class_namespace .= '\\' . $arg;
                        $this->target_name .= '\\' . ucfirst($arg);
                    }
                }
            }
        }
    }

    /**
     * Generator file
     * @return string
     */
    public function make(){
        $this->parseArgument();
        $stub_file = $this->dir . '/' . $this->name;
        if(file_exists($stub_file)){
            $content = file_get_contents($stub_file);
            $content = str_replace('$CLASS$', $this->class_name . $this->target_suffix, $content);
            $content = str_replace('$NAMESPACE$', $this->class_namespace, $content);
            if(!is_dir($this->target_dir)){
                mkdir(iconv("UTF-8", "GBK", $this->target_dir), 0777, true);
            }

            if(!file_exists($this->target_name . $this->target_suffix . '.php')){
                file_put_contents($this->target_name . $this->target_suffix . '.php', $content);
            }else{
                echo $this->target_name . $this->target_suffix . '.php existed';
                exit;
            }
        }
        return $this->target_name . $this->target_suffix . '.php';
    }
}