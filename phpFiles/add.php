<?php
require_once '../class/UserFunctions.php';
UserFunctions::addUser($_POST['e-mail'], $_POST['heslo']);
if (UserFunctions::isLoged()) {
    header("Location: ../seznam.php");
die();
}
header("Location: ../index.php");
die();
