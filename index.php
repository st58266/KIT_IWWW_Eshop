<?php
session_start();
ob_start();
require_once 'class/UserFunctions.php';
require_once 'class/itemFunctions.php';
include 'class/CartFunctions.php';
//
//$banana = array(
//    "id" => 1,
//    "img" => "&#127820",
//    "name" => "banana",
//    "price" => "29",
//);
//$apple = array(
//    "id" => 2,
//    "img" => "&#127823",
//    "name" => "apple",
//    "price" => "39",
//);
//$pepper = array(
//    "id" => 3,
//    "img" => "&#127817",
//    "name" => "watermelon",
//    "price" => "59",
//);
//$potato = array(
//    "id" => 4,
//    "img" => "&#129364",
//    "name" => "potato",
//    "price" => "19",
//);
//$catalog = array($banana, $apple, $pepper, $potato);

//function getBy($att, $value, $array) {
//    foreach ($array as $key => $val) {
//        if ($val[$att] === $value) {
//            return $key;
//        }
//    }
//    return null;
//}

if (isset($_GET['action'])) {
    if ($_GET["action"] == "add" && !empty($_GET["id"])) {
        addToCart($_GET["id"]);
        header("Location: ");
    }

    if ($_GET["action"] == "remove" && !empty($_GET["id"])) {
        removeFromCart($_GET["id"]);
        header("Location: ");
    }

    if ($_GET["action"] == "delete" && !empty($_GET["id"])) {
        deleteFromCart($_GET["id"]);
        header("Location: ");
    }
}


?>

<html>
    <head>
        <title>ESHOP</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
<?php
if (!UserFunctions::isLoged()) {
    include 'includes/login.php';
    exit();
}
include 'includes/menu.php';
?>

        <section id="catalog-items">

        <?php
        $catalog = ItemFunctions::getAllItems();

        foreach ($catalog as $item) {
            echo '
<div class="catalog-item">
<div class="catalog-img">
' . $item["img"] . '
</div>
<h3>
' . $item["name"] . '
</h3>
<div>
' . $item["price"] . '
</div>
<a href="?action=add&id=' . $item["idItems"] . '" class="catalog-buy-button">
Buy
</a>
</div>';
        }
        ?>
        </section>
    </body>
</html>