<?php

require_once '../class/UserFunctions.php';

session_start();
$users = UserFunctions::getAll();
$pass = "###########";
$loginUser;
foreach ($users as $user) {
    if ($user['e-mail'] == $_POST['e-mail']) {
        $pass = $user['password'];       
        $loginUser = $user;
        break;
    }
}
if ($pass == "###########") {
    header("Location: ../index.php");
    die();
}


if ($_POST['heslo'] == $pass) {
    $_SESSION['isLoged'] = true;
    $_SESSION['role'] = $loginUser['Roles_idRoles'];
    $_SESSION['id'] = $loginUser['idUsers'];

    header("Location: ../index.php");
    die();
} else {

    header("Location: ../index.php");
    die();
}