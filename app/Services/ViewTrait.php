<?php

namespace App\Services;

use Component\View\View;

trait ViewTrait{
    /**
     * Parse view
     *
     * @param $view
     * @return View
     */
     function render($view, $params = []){
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