<?php


require_once 'Connection.php';
//session_start();
class UserFunctions {
    static function  isLoged(): bool{
        if ((isset($_SESSION['isLoged']) && $_SESSION['isLoged'])) {
            return true;
        }
        return false;
    }

    static function getAll(): array {
        $conn = Connection::connect();
        $stat = $conn->prepare("SELECT * from users");
        $stat->execute();
        return $stat->fetchAll();
    }
    
    static function getUserId($id){
        $conn = Connection::connect();
        $stat = $conn->prepare("SELECT * from users WHERE idUsers = $id");
        $stat->execute();
        return $stat->fetch();
    }
    
    
    static function getEmails(): array {
        $conn = Connection::connect();
        $stat = $conn->prepare("SELECT e-mail from users");
        $stat->execute();
        return $stat->fetchAll();
    }
    
    static function addUser($email, $heslo) {
        $conn = Connection::connect();
        $stat = $conn->prepare("INSERT INTO `users` (`e-mail`, `password`, `Roles_idRoles`) VALUES (:email, :heslo, '2')");
        $stat->execute([
            'email' => $email,
            'heslo' => $heslo,
        ]);
    }
    
    static function editUser($id, $email, $heslo, $admin) {
        $conn = Connection::connect();
        $stat = $conn->prepare("UPDATE `users` SET `e-mail` = :email, `password` = :heslo, `Roles_idRoles` = :admin  WHERE idUsers = :id");
        if ($admin == 'on') {
            $admin = 1;
        }else{
            $admin = 2;
        }
        $stat->execute([
            'email' => $email,
            'admin' => $admin,
            'heslo' => $heslo,
            'id' => $id, 
        ]);
    }
    
    static function removeUser($id) {
        $conn = Connection::connect();
        $stat = $conn->prepare("DELETE FROM `users` WHERE idUsers = :id");
        $stat->execute([
            'id' => $id,
        ]);
    }

}
