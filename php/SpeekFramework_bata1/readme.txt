SpeekFramework_bata1

     环境要求：
     PHP+Mysql+Apache
     使用步骤：
1、建立接口文件(index.php)到项目目录
2、配置基本信息 
     index.php
     ************************************
     define('SPEEK_PATH','Speek');
     define('APP_PATH','/项目目录');	
     require 'Speek/Speek.php';
     $app = new Control();
     $app->Run();
     ************************************
3   SpeekFramework目录基本结构
                      ——   Configs         系统及配置文件  
                    |
                     ——    Controls        控制系文件夹 
                    |
                     ——    Models          模块文件夹 
     项目目录  |
                     ——    templates      模板文件夹
                    |
                     ——    templates_c   模板编译文件夹
                    |
                     ——    Speek_cache  模板缓存文件夹
