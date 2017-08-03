<?php

namespace App\Controllers;

use Lib\View\View;
use App\Models\Article;

class HomeController{
    public function index(){
        View::make('index')->with('articles', Article::all())
                           ->withTitle('Mark的私人PHP框架')
                           ->load();
    }

    public function view($id){
        View::make('article/view')->with('article', Article::find($id))
                                  ->withTitle('Mark的私人PHP框架')
                                  ->load();
    }
}