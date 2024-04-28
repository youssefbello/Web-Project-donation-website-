<?php

require '../config.php';


class userC {
    public function listUsers() {
        $sql_request = "SELECT * FROM user_table";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql_request);
            return $liste;
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function listAdmins() {
        $sql_request = "SELECT * FROM admin_table";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql_request);
            return $liste;
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function listVIPs() {
        $sql_request = "SELECT * FROM vip_table";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql_request);
            return $liste;
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function deleteUser($id) {
        $sql_request = "DELETE FROM user_table WHERE id=:id";
        $db = config::getConnexion();
        $request = $db->prepare($sql_request);
        $request->bindValue(':id', $id);
        try {
            $request->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function deleteAdmin($id) {
        $sql_request = "DELETE FROM admin_table WHERE id_admin=:id";
        $db = config::getConnexion();
        $request = $db->prepare($sql_request);
        $request->bindValue(':id', $id);
        try {
            $request->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function deleteVip($id) {
        $sql_request = "DELETE FROM vip_table WHERE id=:id";
        $db = config::getConnexion();
        $request = $db->prepare($sql_request);
        $request->bindValue(':id', $id);
        try {
            $request->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function addAdmin(user $u) {
        $sql_request = "INSERT INTO admin_table VALUES (NULL, :namee, :last_name, :username, :pass, :age, :email, :rol, :tel)";
        $db = config::getConnexion();
        $request = $db->prepare($sql_request);
        $request->bindValue(':namee', $u->getName());
        $request->bindValue(':last_name', $u->getLastName());
        $request->bindValue(":username", $u->getUsername());
        $request->bindValue(":pass", $u->getPassword());
        $request->bindValue(':age', $u->getAge());
        $request->bindValue(":email", $u->getEmail());
        $request->bindValue(":rol", $u->getRole());
        $request->bindValue(":tel", $u->getTel());
        try {
            $request->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function addUser(user $u) {
        $sql_request = "INSERT INTO user_table VALUES (NULL, :namee, :last_name, :username, :pass, :age, :email, :rol, :tel)";
        $db = config::getConnexion();
        $request = $db->prepare($sql_request);
        $request->bindValue(':namee', $u->getName());
        $request->bindValue(':last_name', $u->getLastName());
        $request->bindValue(":username", $u->getUsername());
        $request->bindValue(":pass", $u->getPassword());
        $request->bindValue(':age', $u->getAge());
        $request->bindValue(":email", $u->getEmail());
        $request->bindValue(":rol", $u->getRole());
        $request->bindValue(":tel", $u->getTel());
        try {
            $request->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function addVip(user $u) {
        $sql_request = "INSERT INTO vip_table VALUES (NULL, :namee, :last_name, :username, :pass, :age, :email, :cc, :ccv, :rol, :tel)";
        $db = config::getConnexion();

        $request = $db->prepare($sql_request);
        $request->bindValue(':namee', $u->getName());
        $request->bindValue(':last_name', $u->getLastName());
        $request->bindValue(":username", $u->getUsername());
        $request->bindValue(":pass", $u->getPassword());
        $request->bindValue(':age', $u->getAge());
        $request->bindValue(":email", $u->getEmail());
        $request->bindValue(":cc", $u->getCc());
        $request->bindValue(":ccv", $u->getCcv());
        $request->bindValue(":rol", $u->getRole());
        $request->bindValue(":tel", $u->getTel());

        try {
            $request->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function checkUser($user) {
        $sql_request = "SELECT * FROM user_table WHERE username = :username";
        $db = config::getConnexion();
        $request = $db->prepare($sql_request);
        $request->bindValue(":username", $user);
        try {
            $request->execute();
            $result = $request->fetchAll();
            return $result;
        } catch (Exception $e) {
            die("Error: ".$e->getMessage());
        }
    }
    public function checkUserVIP($user) {
        $sql_request = "SELECT * FROM vip_table WHERE username = :username";
        $db = config::getConnexion();
        $request = $db->prepare($sql_request);
        $request->bindValue(":username", $user);
        try {
            $request->execute();
            $result = $request->fetchAll();
            return $result;
        } catch (Exception $e) {
            die("Error: ".$e->getMessage());
        }
    }
    public function checkUserAdmin($user) {
        $sql_request = "SELECT * FROM admin_table WHERE username = :username";
        $db = config::getConnexion();
        $request = $db->prepare($sql_request);
        $request->bindValue(":username", $user);
        try {
            $request->execute();
            $result = $request->fetchAll();
            return $result;
        } catch (Exception $e) {
            die("Error: ".$e->getMessage());
        }
    }
    public function checkAdmin($user) {
        $sql_request = "SELECT * FROM admin_table WHERE username = :username";
        $db = config::getConnexion();
        $request = $db->prepare($sql_request);
        $request->bindValue(":username", $user);
        try {
            $request->execute();
            $result = $request->fetchAll();
            return $result;
        } catch (Exception $e) {
            die("Error: ".$e->getMessage());
        }
    }
    public function updateUser(user $u, $id) {
        $db = config::getConnexion();
        $request = $db->prepare(
            'UPDATE user_table SET
                name = :namee, last_name = :last_name, username = :username, password = :pass, age = :age, email = :email, role = :rol, tel = :tel
            WHERE id = :id'
        );
        $request->bindValue(":id", $id);
        $request->bindValue(":namee", $u->getName());
        $request->bindValue(':last_name', $u->getLastName());
        $request->bindValue(':username', $u->getUsername());
        $request->bindValue(':pass', $u->getPassword());
        $request->bindValue(':age', $u->getAge());
        $request->bindValue(':email', $u->getEmail());
        $request->bindValue(':rol', $u->getRole());
        $request->bindValue(':tel', $u->getTel());
        try {
            $request->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function updateUserVIP(user $u, $id) {
        $db = config::getConnexion();
        $request = $db->prepare(
            'UPDATE vip_table SET
                name = :namee, last_name = :last_name, username = :username, password = :pass, age = :age, email = :email, cc = :cc, ccv = :ccv, role = :rol, tel = :tel
            WHERE id = :id'
        );
        $request->bindValue(":id", $id);
        $request->bindValue(":namee", $u->getName());
        $request->bindValue(':last_name', $u->getLastName());
        $request->bindValue(':username', $u->getUsername());
        $request->bindValue(':pass', $u->getPassword());
        $request->bindValue(':age', $u->getAge());
        $request->bindValue(':email', $u->getEmail());
        $request->bindValue(':cc', $u->getCc());
        $request->bindValue(':ccv', $u->getCcv());
        $request->bindValue(':rol', $u->getRole());
        $request->bindValue(':tel', $u->getTel());
        try {
            $request->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function updateAdmin(user $u, $id) {
        $db = config::getConnexion();
        $request = $db->prepare(
            'UPDATE admin_table SET
                name = :namee, last_name = :last_name, username = :username, password = :pass, age = :age, email = :email, role = :rol, tel = :tel
            WHERE id_admin = :id'
        );
        $request->bindValue(":id", $id);
        $request->bindValue(":namee", $u->getName());
        $request->bindValue(':last_name', $u->getLastName());
        $request->bindValue(':username', $u->getUsername());
        $request->bindValue(':pass', $u->getPassword());
        $request->bindValue(':age', $u->getAge());
        $request->bindValue(':email', $u->getEmail());
        $request->bindValue(':rol', $u->getRole());
        $request->bindValue(':tel', $u->getTel());
        try {
            $request->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function emailExists($email) {
        $sql_request = "SELECT * FROM user_table WHERE email = :email";
        $db = config::getConnexion();

        $request = $db->prepare($sql_request);
        $request->bindValue(":email", $email);

        try {
            $request->execute();
            $result = $request->fetchAll();
            return $result;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function emailExistsVIP($email) {
        $sql_request = "SELECT * FROM vip_table WHERE email = :email";
        $db = config::getConnexion();

        $request = $db->prepare($sql_request);
        $request->bindValue(":email", $email);

        try {
            $request->execute();
            $result = $request->fetchAll();
            return $result;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function emailExistsAdmin($email) {
        $sql_request = "SELECT * FROM admin_table WHERE email = :email";
        $db = config::getConnexion();

        $request = $db->prepare($sql_request);
        $request->bindValue(":email", $email);

        try {
            $request->execute();
            $result = $request->fetchAll();
            return $result;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function checkEmailPassword($email, $password) {
        $sql_request = "SELECT * FROM user_table WHERE email = :email";
        $db = config::getConnexion();
        $request = $db->prepare($sql_request);
        $request->bindValue(":email", $email);
        $request->bindValue(":pass", $password);
        try {
            $request->execute();
            $result = $request->fetchAll();
            if (password_verify($password, $result[0]["password"])) {
                return $result;
            } else {
                return NULL;
            }
        }
        catch (Exception $e) {
            die("Error: ". $e->getMessage());
        }
    }
    public function checkEmailPasswordVIP($email, $password) {
        $sql_request = "SELECT * FROM vip_table WHERE email = :email";
        $db = config::getConnexion();
        $request = $db->prepare($sql_request);
        $request->bindValue(":email", $email);
        $request->bindValue(":pass", $password);
        try {
            $request->execute();
            $result = $request->fetchAll();
            if (password_verify($password, $result[0]["password"])) {
                return $result;
            } else {
                return NULL;
            }
        }
        catch (Exception $e) {
            die("Error: ". $e->getMessage());
        }
    }
    public function checkEmailPasswordAdmin($email, $password) {
        $sql_request = "SELECT * FROM admin_table WHERE email = :email";
        $db = config::getConnexion();
        $request = $db->prepare($sql_request);
        $request->bindValue(":email", $email);
        $request->bindValue(":pass", $password);
        try {
            $request->execute();
            $result = $request->fetchAll();
            if (password_verify($password, $result[0]["password"])) {
                return $result;
            } else {
                return NULL;
            }
        }
        catch (Exception $e) {
            die("Error: ". $e->getMessage());
        }
    }
    public function checkUserPassword($username, $password) {
        $sql_request = "SELECT * FROM user_table WHERE username = :username";
        $db = config::getConnexion();
        $request = $db->prepare($sql_request);
        $request->bindValue(":username", $username);
        try {
            $request->execute();
            $result = $request->fetchAll();
            if (count($result) > 0) {
                if (password_verify($password, $result[0]["password"])) {
                    return $result;
                } else {
                    return NULL;
                }
            }
        }
        catch (Exception $e) {
            die("Error: ". $e->getMessage());
        }
    }
    public function checkUserPasswordVIP($username, $password) {
        $sql_request = "SELECT * FROM vip_table WHERE username = :username";
        $db = config::getConnexion();
        $request = $db->prepare($sql_request);
        $request->bindValue(":username", $username);
        try {
            $request->execute();
            $result = $request->fetchAll();
            if (count($result) > 0) {
                if (password_verify($password, $result[0]["password"])) {
                    return $result;
                } else {
                    return NULL;
                }
            }
        }
        catch (Exception $e) {
            die("Error: ". $e->getMessage());
        }
    }
    public function checkUserPasswordAdmin($username, $password) {
        $sql_request = "SELECT * FROM admin_table WHERE username = :username";
        $db = config::getConnexion();
        $request = $db->prepare($sql_request);
        $request->bindValue(":username", $username);
        try {
            $request->execute();
            $result = $request->fetchAll();
            if (count($result) > 0) {
                if (password_verify($password, $result[0]["password"])) {
                    return $result;
                } else {
                    return NULL;
                }
            }
        }
        catch (Exception $e) {
            die("Error: ". $e->getMessage());
        }
    }
    public function retrieveUser($id) {
        $sql_request = "SELECT * FROM user_table WHERE id = :id";
        $db = config::getConnexion();
        $request = $db->prepare($sql_request);
        $request->bindValue(":id", $id);
        try {
            $request->execute();
            $result = $request->fetchAll();
            if (!empty($result)) {
                return $result[0];
            } else {
                return null;
            }
        } catch (Exception $e) {
            die("Error: ". $e->getMessage());
        }
    }
    public function retrieveVIP($id) {
        $sql_request = "SELECT * FROM vip_table WHERE id = :id";
        $db = config::getConnexion();
        $request = $db->prepare($sql_request);
        $request->bindValue(":id", $id);
        try {
            $request->execute();
            $result = $request->fetchAll();
            if (!empty($result)) {
                return $result[0];
            } else {
                return null;
            }
        } catch (Exception $e) {
            die("Error: ". $e->getMessage());
        }
    }
    public function retrieveAdmin($id) {
        $sql_request = "SELECT * FROM admin_table WHERE id_admin = :id";
        $db = config::getConnexion();
        $request = $db->prepare($sql_request);
        $request->bindValue(":id", $id);
        try {
            $request->execute();
            $result = $request->fetchAll();
            if (!empty($result)) {
                return $result[0];
            } else {
                return null;
            }
        } catch (Exception $e) {
            die("Error: ". $e->getMessage());
        }
    }
    public function searchUsersByUsername($username) {
        $tables = ['user_table', 'admin_table', 'vip_table'];
        $results = [];
    
        $db = config::getConnexion();
    
        foreach ($tables as $table) {
            $sql_request = "SELECT * FROM $table WHERE username LIKE :username";
            $request = $db->prepare($sql_request);
            $request->bindValue(":username", '%' . $username . '%');
    
            try {
                $request->execute();
                $result = $request->fetchAll();
    
                $results[$table] = $result;
            } catch (Exception $e) {
                die("Error: " . $e->getMessage());
            }
        }
    
        return $results;
    }
    
}

?>