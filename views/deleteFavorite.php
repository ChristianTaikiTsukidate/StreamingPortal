<?php
require_once("../controller/config.php");
require_once("../models/connection.php");
require_once("../models/users.php");
$users = new Users();
$users->deleteWatchlistItem($_GET['id'], $_SESSION['userId']);