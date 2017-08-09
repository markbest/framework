<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Article;

class HomeController extends Controller
{
    public function index(){
        $this->render('index', [
            'articles' => Article::all(),
            'title' => 'Mark的私人PHP框架'
        ]);
    }

    public function view($id){
        $this->render('article.view', [
            'article' => Article::find($id),
            'title' => 'Mark的私人PHP框架'
        ]);
    }
}