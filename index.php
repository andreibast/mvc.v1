<?php


define('DS', DIRECTORY_SEPARATOR); //this is to find what separator you need to use for your folders
define('ROOT', dirname(__FILE__)); 

//load configuration and helper functions
require_once(ROOT . DS . 'config' . DS . 'config.php');
require_once(ROOT . DS . 'app' . DS . 'lib' . DS . 'helpers' . DS . 'functions.php');

//autoload our classes

//when it loads a class name, it will look in the root folders(controllers or models in the example), and will look for className.php if that exists. Every time we add a new class, we will not need to add a require function(because of autoload).
function autoload($className) {
    if(file_exists(ROOT . DS . 'core' . DS . $className . '.php')){
        require_once(ROOT . DS . 'core' . DS . $className . '.php');
    }elseif(file_exists(ROOT . DS . 'app' . DS . 'controllers' . DS . $className . '.php')){
        require_once(ROOT . DS . 'app' . DS . 'controllers' . DS . $className . '.php');
    }elseif(file_exists(ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php')){
        require_once(ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php');
    }
}

spl_autoload_register('autoload');  //standard php library function, new in php. Transforms the function into a string
session_start();


$url =isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'],'/')) : [];
$db = DB::getInstance();
//dnd($db); //->this throws you an array


//phpinfo(); die(); //never do this on live server. With this you can check your server parameters and also your extension class


//Route the request. :: means you make a static function. And you passed through the method route from Router, the parameter $url
Router::route($url); 

