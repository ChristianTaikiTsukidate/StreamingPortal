<?php
if(!isset($_SESSION['role']))
{
    $_SESSION['role'] = 'user';
}
if($_SESSION['role'] == 'admin')
{
    /** database config **/
    define('DBNAME', 'streamingportal');
    define('DBHOST', 'localhost');
    define('DBUSER', 'editor');
    define('DBPASS', '123abc');
    define('DBPORT', '3306');
}else
{
    /** database config **/
    define('DBNAME', 'streamingportal');
    define('DBHOST', 'localhost');
    define('DBUSER', 'user');
    define('DBPASS', '123abc');
    define('DBPORT', '3306');
}
$_SESSION["backgroundIndex"] = 1;
require_once('../models/connection.php');