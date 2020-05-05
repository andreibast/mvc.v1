<?php

class DB {

    //we use a singleton pattern. We check if the class has been instantiated, and if so the object will be stored in a property called instance(static).
    //static = it doesnt change, it's accessible / it spans all objects that were created at the class
    //singleton pattern because I dont want to create more than one connection to the db. There is no reason to and it would waste memory and slow down the app.

    //these are properties
    private static $_instance = null; 
    private $_pdo, $_query, $_error = false, $_result, $_count =0, $_lastInsertID= null;

    private function __construct(){
        //we are going to instantiate our PDO object (an extension of php, most php have it installed by default but not all). Use phpinfo() function to see your server status, and which type of databases accepts. 

        try{
            $this->_pdo = new PDO('mysql:host='.DB_HOST. ';dbname='.DB_NAME, DB_USER, DB_PASSWORD);//if you write in host localhost, you will have big performance issues. So use IP instead. For security reasons, we added a function that hides the real value, in config.php). In live servers, you take the IP of the real server.
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function query($sql, $params = []){
        $this->_error = false;
        if($this->_query = $this->_pdo->prepare($sql)){
            $x =1;
            if(count($params)){
                foreach($params as $param){
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            if($this->_query->execute()){
                $this->_result = $this->_query->fetchALL(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
                $this->_lastInsertID = $this->_pdo->lastInsertID();
            }else{
                $this->_error =true;
            }
        }
        return $this;
    }

    protected function _read($table, $params=[]){
        $conditionString ='';
        $bind = [];
        $order = '';
        $limit = '';

        //conditions
        if(isset($params['conditions'])){
            if(is_array($params['conditions'])){
                foreach($params['conditions'] as $condition){
                    $conditionString .= ' ' . $condition . ' AND';
                }
                $conditionString =trim($conditionString);
                $conditionString =rtrim($conditionString, ' AND');
            }else{
                $conditionString = $params['conditions'];
            }
            if($conditionString != ''){
                $conditionString = ' Where ' . $conditionString;
                
            }
        }
        //bind
        if(array_key_exists('bind', $params)){
            $bind = $params['bind'];
        }
        //order
        if(array_key_exists('order', $params)){
            $order = ' ORDER BY ' . $params['order'];
        }
        //limit
        if(array_key_exists('limit', $params)){
            $limit = ' LIMIT ' . $params['limit'];
        }

        $sql = "SELECT * FROM {$table}{$conditionString}{$order}{$limit}";
        if($this->query($sql, $bind)){
            if(!count($this->_result)) return false;
                return true;
        }
        return false;
    }

    public function find($table, $params=[]){
        if($this->_read($table, $params)){
            return $this->results();
        }
        return false;
    }

    public function findFirst($table, $params=[]){
        if($this->_read($table, $params)){
            return $this->first();
        }
        return false;
    }

    public function insert($table, $fields =[]){
        $fieldString = '';
        $valueString = '';
        $values = [];

        foreach($fields as $field => $value){
            $fieldString .= '`' . $field . '`,';
            $valueString .= '?,';
            $values[] = $value; 
        }

        $fieldString = rtrim($fieldString, ',');
        $valueString = rtrim($valueString, ',');
        $sql = "INSERT INTO {$table} ({$fieldString}) VALUES ({$valueString})";
        if(!$this->query($sql, $values)->error()){
            return true;
        }
        return false;
    }

    public function update($table, $id, $fields = []){
        $fieldString = '';
        $values = [];
        foreach($fields as $field => $value){
            $fieldString .= ' ' . $field . ' = ?,'; 
            $values[] = $value;
        }
        $fieldString= trim($fieldString);
        $fieldString = rtrim($fieldString, ',');
        $sql = "UPDATE {$table} SET {$fieldString} WHERE id = {$id}";
        if(!$this->query($sql, $values)->error()){
            return true;
        }
        return false;
    }

    public function delete($table, $id) {
        $sql = "DELETE FROM {$table} WHERE id = {$id}";
        if(!$this->query($sql)->error()){
            return true;
        }
        return false;
    }

    public function results(){
        return $this->_result;
    }

    public function first(){
        return (!empty($this->_result)) ? $this->_result[0] : [];
    }

    public function count(){
        return $this->_count;
    }

    public function lastID(){
        return $this->_lastInsertID;
    }

    public function get_columns($table){ //returns columns properties settings within a selected table
        return $this->query("SHOW COLUMNS FROM {$table}")->results();
    }


    public function error(){
        return $this->_error;
    }


}