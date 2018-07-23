<?php

class DB_functions {

    private $conn;

    function __construct() {
        require_once 'db_connect.php';
        $db = new DB_Connect();
        $this->conn = $db->connect();
    }

    function __destruct() {
        
    }

    function checkExitsUser($phone) {

        $stmt = $this->conn->prepare("SELECT * FROM user WHERE Phone=?");
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }

    public function registerNewUser($phone, $name, $birthdate, $address) {

        $stmt = $this->conn->prepare("INSERT INTO user(Phone, Name, Birthdate, Address) VALUES(?,?,?,?)");
        $stmt->bind_param("ssss", $phone, $name, $birthdate, $address);
        $result = $stmt->execute();
        $stmt->close();

        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM user WHERE Phone =?");
            $stmt->bind_param("s", $phone);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        } else {
            return false;
        }
    }

    public function getUserInformation($phone) {

        $stmt = $this->conn->prepare("SELECT * FROM user WHERE Phone=?");
        $stmt->bind_param("s", $phone);

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        } else {
            return NULL;
        }
    }

    public function getBanner() {
        $result = $this->conn->query("SELECT * FROM banner ORDER BY ID LIMIT 3");
        $banners = array();
        while ($item = $result->fetch_assoc()) {
            $banners[] = $item;
        }
        return $banners;
    }

    public function getMenu() {
        $result = $this->conn->query("SELECT * FROM menu");
        $menu = array();
        while ($item = $result->fetch_assoc()) {
            $menu[] = $item;
        }
        return $menu;
    }

    public function getDrinkByMenuID($menuid) {

        $query = "SELECT * FROM drink WHERE MenuId='" . $menuid . "'";
        $result = $this->conn->query($query);

        $drink = array();
        while ($item = $result->fetch_assoc()) {
            $drink[] = $item;
        }
        return $drink;
    }

}

?>