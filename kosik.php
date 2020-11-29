<?php
session_start();
include_once 'class/ItemFunctions.php';
include_once 'class/UserFunctions.php';
include 'class/CartFunctions.php';

function getBy($att, $value, $array) {
    foreach ($array as $key => $val) {
        if ($val[$att] === $value) {
            return $key;
        }
    }
    return null;
}

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

$catalog = ItemFunctions::getAllItems();
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
//echo '<pre>';
//var_dump($_SESSION);
//echo '</pre>';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
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
        <section>
            <h2>Shopping cart</h2>
            <?php
            $totalPrice = 0;
            foreach ($_SESSION["cart"] as $key => $value) { //key = id        value = array[quantity]
                $item = $catalog[$key - 1];
                $totalPrice = $totalPrice + ($value["quantity"] * $item["price"]);
                echo '
<div class="cart-item">
<div class="cart-img">
' . $item["img"] . '
</div>
<div>
' . $item["name"] . '
</div>
<div class="cart-control">
<div class="cart-price">
' . $item["price"] . '
</div>
<div class="cart-quantity">
' . ($value["quantity"]) . '
</div>
<div class="cart-quantity">
' . ($value["quantity"] * $item["price"]) . '
</div>
<a href="?action=add&id=' . $item["idItems"] . '" class="cart-button">
+
</a>
<a href="?action=remove&id=' . $item["idItems"] . '" class="cart-button">
-
</a>
<a href="?action=delete&id=' . $item["idItems"] . '" class="cart-button">
x
</a>
</div>
</div>';
            }

            echo "<div id='cart-total-price'>Total price: $totalPrice</div>";

            if ($totalPrice != 0) {
                echo '<div class="radek">
                <form action="phpFiles/addObjednavka.php" method="post">
                    <input type="submit"/>
                </form>
            </div> ';
            }
            ?>

        </section>
    </body>
</html>
