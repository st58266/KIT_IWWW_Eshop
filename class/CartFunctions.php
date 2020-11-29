<?php
function addToCart($productId) {
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }
    if (!array_key_exists($productId, $_SESSION["cart"])) {
        $_SESSION["cart"][$productId]["quantity"] = 1;
    } else {
        $_SESSION["cart"][$productId]["quantity"] ++;
    }
}

function removeFromCart($productId) {
    if (array_key_exists($productId, $_SESSION["cart"])) {
        if ($_SESSION["cart"][$productId]["quantity"] <= 1) {
            unset($_SESSION["cart"][$productId]);
        } else {
            $_SESSION["cart"][$productId]["quantity"] --;
        }
    }
}

function deleteFromCart($productId) {
    unset($_SESSION["cart"][$productId]);
}