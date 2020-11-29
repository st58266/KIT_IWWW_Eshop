<?php

session_start();
include_once '../class/ObjednavkyFunctions.php';
ObjednavkyFunctions::addObjednavka();
$_SESSION["cart"] = [];
header("Location: ../objednavky.php");
