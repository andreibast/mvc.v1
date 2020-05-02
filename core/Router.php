<?php
//The file itself must be named in uppercase, so the autoload function set in bootstrap.php knows its a class

class Router{
    public static function route($url){ // 
        //1.these line codes show what data the array has stored, and which are those values for each slot
        // var_dump($url);
        // die();

        //2.Same as above but using dnd function
        // dnd($url);

        //3.We are going to extract from our URL, our controller
        $controller = (isset($url[0]) && $url[0] !='') ? ucwords($url[0]) : DEFAULT_CONTROLLER; //ucwords is because the classes are uppercase
        $controller_name = $controller;
        array_shift($url);

        //Action
        $action = (isset($url[0]) && $url[0] !='') ? $url[0]. 'Action' : 'indexAction'; 
        $action_name = $controller;
        array_shift($url);


        // echo $controller . '<br>';
        // echo $action . '<br>';
        // dnd($url);

        //Parameters
        $queryParams = $url;

        //we instantiate a new object
        $dispatch = new $controller($controller_name, $action);
        
        if(method_exists($controller, $action)){
            call_user_func_array([$dispatch, $action], $queryParams); //allows us to call a callback function with an array of parameters passed into it
        } else {
            die('That method does not exist in the controller \"' . $controller_name . '\"');
        }
    }
    
}