<?php
require_once("../../header.php");
require_once("../../../models/connection.php");
require_once("../../../models/users.php");
$users = new Users();
$users->insertWatchlistItem($_GET['id'], $_SESSION['userId']);