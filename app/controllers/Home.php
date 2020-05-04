<?php

class Home extends Controller {

    public function __construct($controller, $action){
        parent::__construct($controller, $action);
    }

    public function indexAction(){ //you can record what is typed into the search bar as URL and act accordingly
        // echo $name;
        $this->view->render('home/index');
    }


} 