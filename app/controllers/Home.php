<?php

class Home extends Controller {

    public function __construct($controller, $action){
        parent::__construct($controller, $action);
    }

    public function indexAction(){ //you can record what is typed into the search bar as URL and act accordingly
        // echo $name;

        $db = DB::getInstance();
        // $fields = [
        //     'fname' => 'Andreyy',
        //     'email' => 'andreyy@yepyep.com'
        // ];
        //$contactsQ = $db->insert('contacts', $fields);
        //$contactsQ = $db->update('contacts',3, $fields);
        //$contactsQ = $db->delete('contacts',3);
        //$contact = $db->query("SELECT * FROM contacts ORDER BY lname, fname")->first();

        // $columns = $db->get_columns('contacts');
        // dnd($columns);

        $contacts = $db->findFirst('contacts', [
            'conditions' => "lname = ?",
            'bind' => ['B'],
            
        ]);

        dnd($contacts);


    
        $this->view->render('home/index');
    }


} 