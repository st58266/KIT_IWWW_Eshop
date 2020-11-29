<?php
session_start();
include_once 'class/ObjednavkyFunctions.php';
include_once 'class/ItemFunctions.php';
include_once 'class/UserFunctions.php';
include_once 'class/CartFunctions.php';

function getBy($att, $value, $array) {
    foreach ($array as $key => $val) {
        if ($val[$att] === $value) {
            return $key;
        }
    }
    return null;
}

$polozky = ObjednavkyFunctions::getObjednavkaIdItems($_GET["id"]);
if ($polozky == null) {
    header("Location: objednavky.php");
}

$catalog = ItemFunctions::getAllItems();
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
            <h2>Detail</h2>
            <?php
            $totalPrice = 0;
            $polozky = ObjednavkyFunctions::getObjednavkaIdItems($_GET["id"]);
            if ($polozky == null) {
                
            }
            foreach ($polozky as $value) {
                $item = $catalog[$value["Items_idItems"] - 1];
                $totalPrice = $totalPrice + ($value["Quantity"] * $value["OriginalCost"]);
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
' . $value["OriginalCost"] . '
</div>
<div class="cart-quantity">
' . ($value["Quantity"]) . '
</div>
<div class="cart-quantity">
' . ($value["Quantity"] * $value["OriginalCost"]) . '
</div>

</div>
</div>';
            }

            echo "<div id='cart-total-price'>Total price: $totalPrice</div>";
            ?>

        </section>
    </body>
</html>
