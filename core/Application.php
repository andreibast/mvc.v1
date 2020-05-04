<?php

class Application{

    //will start when the object is instantiated
    public function __construct(){
        $this->_set_reporting();
        $this->_unregister_globals();
    }

    private function _set_reporting(){
        if(DEBUG){
            error_reporting(E_ALL);
            ini_set('display_errors', 1); //1 is true
        }else{
            error_reporting(0);
            ini_set('display_errors', 0); //0 is false
            ini_set('log_errors', 1);
            ini_set('errors_log', ROOT . DS . 'tmp' . DS . 'logs' . DS . 'errors.log');
        }
    }
    

    private function _unregister_globals(){  // registring globals in the array is considered a security flaw into cookies

       if(ini_get('register_globals')){
           $globalsAry = ['_SESSION', '_COOKIE', '_POST', '_GET', '_REQUEST', '_SERVER', '_ENV','_FILES'];
           foreach($globalsAry as $g){
               foreach($GLOBALS[$g] as $k => $v){
                   if($GLOBALS[$k] === $v){
                       unset($GLOBALS[$k]);
                   }
               }
           }
       } 
    }

    
}



