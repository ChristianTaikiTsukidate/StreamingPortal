<?php
if(isset($_POST["register"])){
    require_once("../models/connection.php");
    require_once("../models/users.php");

    $users = new Users();
    $users->insertUser();
    header("location:login.php");
}