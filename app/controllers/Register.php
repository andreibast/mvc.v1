<?php

Class Register extends Controller{

    public function _construct($controller, $action){
        parent::__construct($controller, $action);
        $this->load_model('Users');
        $this->view->setLayout('default');
    }

    public function loginAction(){
        // echo Session::uagent_no_version();
        // echo password_hash('password', PASSWORD_DEFAULT); //the printed hash is used as a password for the session
        if($_POST){

            //form validation
            $validation = true;
            if($validation === true){
                $user = $this->UsersModel->findByUsername($_POST['username']);
                if($user && password_verify(Input::get('password'), $user->password)){
                    $remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false;
                    $user->login($remember);
                    Router::redirect('');
                }
            }
        }


        $this->view->render('register/login'); //grabs the login file
    }

}


