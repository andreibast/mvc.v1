<?php
session_start();

define('DS', DIRECTORY_SEPARATOR); //this is to find what separator you need to use for your folders
// echo DS;

define('ROOT', dirname(__FILE__)); 
// echo $_SERVER['PATH_INFO']; 
// die();

// echo ROOT;

//we are creating an array from our url. It breaks into chunks when it sees '/' and then puts it into an array.

$url =isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'],'/')) : [];

require_once(ROOT . DS . 'core' . DS . 'bootstrap.php');
