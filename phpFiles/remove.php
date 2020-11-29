<?php
require_once '../class/UserFunctions.php';
UserFunctions::removeUser($_POST['id']);
if (UserFunctions::isLoged()) {
    header("Location: ../seznam.php");
die();
}
header("Location: ../index.php");
die();
