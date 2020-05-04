<?php


class View{
    protected $_head, $_body, $_siteTitle = SITE_TITLE, $_outputBuffer, $_layout = DEFAULT_LAYOUT;


    public function __construct(){

    }

    public function render($viewName){
        $viewAry = explode('/', $viewName);
        $viewString = implode(DS, $viewAry);
        if(file_exists(ROOT . DS . 'app' . DS . 'views' . DS . $viewString . '.php')){
            include(ROOT . DS . 'app' . DS . 'views' . DS . $viewString . '.php');
            include(ROOT . DS . 'app' . DS . 'views' . DS . 'layouts' . DS . $this->_layout . '.php'); //this is for the layout
        }else{
            die('The view \"' . $viewName . '\" does not exist.');
        }
    }

    public function content($type){
        if($type == 'head'){
            return $this->_head;
        }elseif($type == 'body'){
            return $this->_body;
        }
        return false;
    }


    public function start($type) {
        $this->_outputBuffer = $type;
        ob_start(); //starts the output buffer (its built-in PHP function). Its something like a virtual space where it processes data, and after it reaches at the end function, it will clear the space and will display the processed data. 
    }
    
    public function end(){
        if($this->_outputBuffer = 'head'){
            $this->_head=ob_get_clean();
        }elseif($this->_outputBuffer = 'body'){
            $this->_body=ob_get_clean();    
        }else{
            die('You must first run the start method!');
        }
    }

    public function siteTitle(){ //we use this as a getter
        return $this->_siteTitle;    
    }
    
    public function setSiteTitle($title){
        $this->_siteTitle = $title;
    }
    
    public function setLayout($path){
        $this->_layout = $path;
    }
}



