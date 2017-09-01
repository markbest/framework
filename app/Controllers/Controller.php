<?php

namespace App\Controllers;

use Component\View\View;

class Controller
{
    /**
     * Parse view
     *
     * @param $view
     * @return View
     */
    protected function render($view, $params = []){
        $view = View::make($view);
        if(count($params)){
            foreach($params as $name => $value){
                $view->with($name, $value);
            }
        }
        $view->load();
        return $view;
    }
}