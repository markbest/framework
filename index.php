<?php

use Illuminate\Database\Capsule\Manager as Capsule;

// 定义 BASE_PATH
define('BASE_PATH', __DIR__);

// Autoload 自动载入
require BASE_PATH . '/vendor/autoload.php';

// Init Eloquent ORM
$capsule = new Capsule;
$capsule->addConnection(require BASE_PATH . '/config/database.php');
$capsule->bootEloquent();

// 加载路由文件
require BASE_PATH . '/routes/route.php';