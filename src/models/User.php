<?php

class User {
    private $conn;
    private $table = 'users';

    public $userId;
    public $username;
    public $lastName;
    public $name;
    public $password;
    public $phone;
    public $email;
    public $isLogged;
    public $createdAt;
    public $updatedAt;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($username, $password) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE username = :username';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($password, $row['password'])) {
                return $row;
            }
        }
        return null;
    }
}

?>
