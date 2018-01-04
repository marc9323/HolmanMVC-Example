<?php

class User {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Register User
    public function register($data) {
        $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
        // bind parameters
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    // Login User
    public function login($email, $password) {
        $this->db->query('Select * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashed_password = $row->password;

        if(password_verify($password, $hashed_password)) {
            return $row; // return the users row
        } else {
            return false; // no match
        }
    }

    // find user by email (passed in $email from controller)
    public function findUserByEmail($email) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        // bind parameters
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // check row
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    }

    // Get USER by id
    public function getUserById($id) {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        // bind parameters
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;

    }



}