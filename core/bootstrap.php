<?php
//load configuration and helper functions
require_once(ROOT . DS . 'config' . DS . 'config.php');
require_once(ROOT . DS . 'app' . DS . 'lib' . DS . 'helpers' . DS . 'functions.php');

//autoload our classes

//when it loads a class name, it will look in the root folders(controllers or models in the example), and will look for className.php if that exists. Every time we add a new class, we will not need to add a require function(because of autoload).
function __autoload($className) {
    if(file_exists(ROOT . DS . 'core' . DS . $className . '.php')){
        require_once(ROOT . DS . 'core' . DS . $className . '.php');
    }elseif(file_exists(ROOT . DS . 'app' . DS . 'controllers' . DS . $className . '.php')){
        require_once(ROOT . DS . 'app' . DS . 'controllers' . DS . $className . '.php');
    }elseif(file_exists(ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php')){
        require_once(ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php');
    }
}

//Route the request
Router::route($url); 
//:: means you make a static function. And you passed through the method route from Router, the parameter $url

