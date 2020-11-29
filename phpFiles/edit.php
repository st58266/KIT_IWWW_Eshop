<?php
require_once '../class/UserFunctions.php';
UserFunctions::editUser($_POST['id'],$_POST['e-mail'],$_POST['heslo'], $_POST['admin']);
if (UserFunctions::isLoged()) {
    header("Location: ../seznam.php");
die();
}
header("Location: ../index.php");
die();
