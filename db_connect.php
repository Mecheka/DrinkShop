<?php

class DB_Connect{
    private $conn;
    
    public function connect(){
        require_once 'config.php';
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        return$this->conn;
    }
    
}

?>