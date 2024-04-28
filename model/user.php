<?php

class user {
    private ?string $id;
    private string $name;
    private string $last_name;
    private string $username;
    private string $password;
    private int $age = 0;
    private string $email;
    private int $cc;
    private int $ccv;
    private string $role;
    private int $tel = 0;
    public $tmp = NULL;

    public function __construct($tmp, $name, $last_name, $username, $password, $age, $email, $cc, $ccv, $role, $tel) {
        $this->id = $tmp;
        $this->name = $name;
        $this->last_name = $last_name;
        $this->username = $username;
        $this->password = $password;
        $this->age = $age;
        $this->email = $email;
        $this->cc = $cc;
        $this->ccv = $ccv;
        $this->role = $role;
        $this->tel = $tel;
    }
    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function getLastName() {
        return $this->last_name;
    }
    public function setLastName($last_name) {
        $this->last_name = $last_name;
    }
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function getTel() {
        return $this->tel;
    }
    public function setTel($tel) {
        $this->tel = $tel;
    }
    public function getCc() {
        return $this->cc;
    }
    public function setCc($cc) {
        $this->cc = $cc;
    }
    public function getCcv() {
        return $this->ccv;
    }
    public function setCcv($ccv) {
        $this->ccv = $ccv;
    }
    public function getRole() {
        return $this->role;
    }
    public function setRole($role) {
        $this->role = $role;
    }
    public function getAge() {
        return $this->age;
    }
    public function setAge($age) {
        $this->age = $age;
    }
    public function getUsername() {
        return $this->username;
    }
    public function setUsername($username) {
        $this->username = $username;
    }
    public function getPassword() {
        return $this->password;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
}


?>