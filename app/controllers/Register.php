<?php

Class Register extends Controller{

    public function _construct($controller, $action){
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
    }

    public function loginAction(){
        // echo Session::uagent_no_version();
        echo password_hash('password', PASSWORD_DEFAULT); //the printed hash is used as a password for the session
        $this->view->render('register/login'); //grabs the login file
    }

}


