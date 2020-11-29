<?php
session_start();
include_once 'class/ObjednavkyFunctions.php';
include_once 'class/UserFunctions.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body
    <?php
    if (!UserFunctions::isLoged()) {
        include 'includes/login.php';
        exit();
    }
    include 'includes/menu.php';
    ?>
    <?php
    $seznam = ObjednavkyFunctions::getAllObjednavkyForUser($_SESSION["id"]);
    foreach ($seznam as $item) {
        $cena = 0;
        $polozky = ObjednavkyFunctions::getObjednavkaIdItems($item["idObjednavky"]);
        
        foreach ($polozky as $value) {
            $cena += $value["OriginalCost"]*$value["Quantity"];
        }
        echo '<div>'
        . 'Objednavka id = ' . $item["idObjednavky"]
        . ', cena = ' . $cena
        . ' | <a href="detail.php?id='. $item["idObjednavky"] .'">Detail</a>'
        . '</div>';
    }
    ?>
</body>
</html>
