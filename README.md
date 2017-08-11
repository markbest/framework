## framework
自己学习写的一个PHP的MVC框架（正在完善中）

## 依赖库
- [illuminate/database](https://github.com/illuminate/database)
- [symfony/console](https://github.com/symfony/console)
- [monolog/monolog](https://github.com/Seldaek/monolog)

## 框架特色
- 使用composer管理php组件的自动加载
- 框架的M使用的是Laravel的Eloquent
- 框架的V和C都是自己写的简单的组件实现
- 框架命令行用symfony/console实现
- 框架日志使用monolog/monolog实现

## 自带命令  
- 生成控制器：php artisan make:controller [name]
- 生成模型：php artisan make:model [name]
- 生成命令：php artisan make:command [name]
