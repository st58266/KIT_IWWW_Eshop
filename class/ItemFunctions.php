<?php

require_once 'Connection.php';
//session_start();
class ItemFunctions {

    static function getAllItems(): array {
        $conn = Connection::connect();
        $stat = $conn->prepare("SELECT * from items");
        $stat->execute();
        return $stat->fetchAll();
    }
    


}
