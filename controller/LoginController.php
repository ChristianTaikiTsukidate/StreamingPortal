<?php
if(isset($_POST["login"])){
    require_once("../models/connection.php");
    require_once("../models/users.php");

    $users = new Users();
    $user = $users->getUserByEmailAndPassword();
    $_SESSION["userId"] = $user["id"];
    $_SESSION["name"] = $user["name"];
    $_SESSION["email"] = $user["email"];
    $_SESSION["role"] = $user["role"];
    header("location:index.php");
}
