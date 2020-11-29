<?php

require_once 'Connection.php';
require_once 'ItemFunctions.php';

class ObjednavkyFunctions {

    static function getAllObjednavky(): array {
        $conn = Connection::connect();
        $stat = $conn->prepare("SELECT * from objednavky");
        $stat->execute();
        return $stat->fetchAll();
    }

    static function getAllObjednavkyForUser($id): array {
        $conn = Connection::connect();
        $stat = $conn->prepare("SELECT * from objednavky WHERE Users_idUsers = $id");
        $stat->execute();
        return $stat->fetchAll();
    }

    static function getObjednavkaId($id) {
        $conn = Connection::connect();
        $stat = $conn->prepare("SELECT * from objednavky WHERE idObjednavky = $id");
        $stat->execute();
        return $stat->fetch();
    }

    static function getObjednavkaIdItems($id) {
        $conn = Connection::connect();

        $stat = $conn->prepare("SELECT * from objednavky WHERE idObjednavky = $id");
        $stat->execute();
        if ($stat->fetch()["Users_idUsers"] != $_SESSION["id"]) {
            return null;
        }

        $stat = $conn->prepare("SELECT * from objednavkaItem WHERE Objednavky_idObjednavky = :id");
        $stat->execute([
            'id' => $id,
        ]);
        return $stat->fetchAll();
    }

    static function addObjednavka() {
        if (true) {
            
        }
        $uzivatel = $_SESSION["id"];
        $conn = Connection::connect();
        $stat = $conn->prepare("INSERT INTO `objednavky` (`Users_idUsers`) VALUES (:uzivatel)");
        $stat->execute([
            'uzivatel' => $uzivatel,
        ]);
        $last_id = $conn->lastInsertId();
        $catalog = ItemFunctions::getAllItems();
        foreach ($_SESSION["cart"] as $key => $value) {
            $cena = $catalog[$key - 1]["price"];
            $stat = $conn->prepare("INSERT INTO `objednavkaitem` (`Objednavky_idObjednavky`,`Items_idItems`,`OriginalCost`,`Quantity`) VALUES (:objednavkaId, :itemId, :cena, :mnozstvi)");
            $stat->execute([
                'objednavkaId' => $last_id,
                'itemId' => $key,
                'cena' => $cena,
                'mnozstvi' => $value["quantity"],
            ]);
        }
    }

}
