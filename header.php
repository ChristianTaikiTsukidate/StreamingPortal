<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Anime | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/plyr.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom-style.css" type="text/css">
    <link rel="stylesheet" href="css/styleLogin.css">
</head>
<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>
<!-- Header Section Begin -->
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="header__logo">
                    <a href="index.php">
                        <img src="img/logo.png" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="header__nav">
                    <nav class="header__menu mobile-menu">
                        <ul>

                            <li><a href="index.php">Homepage</a></li>
                            <?php
                            if (isset($_SESSION['adminlogin'])) { ?>
                                <li><a href="movieedit.php">Add Movie/Series</a></li>
                                <li><a href="admin/logout.php">Logout</a></li>
                            <?php }?>
                            <?php
                            if (isset($_SESSION['alogin'])) { ?>
                                <li><a href="logout.php">Logout</a></li>
                            <?php } if(!isset($_SESSION['alogin']) && !isset($_SESSION['adminlogin'])) { ?>
                                <li><a href="login.php">Login</a></li>
                            <?php } ?>

                        </ul>
                    </nav>
                </div>
            </div>
            <div class="input-group col align-bottom align-items-center col-lg-4">
                <input type="text" class="form-control" placeholder="Search" id="searchField"/>
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header>
<?php if(isset($_SESSION['alogin'])) {?>
    <?php include('includes/leftbar.php');?>
<?php } ?>
<?php if(isset($_SESSION['adminlogin'])) {?>
    <?php include('admin/includes/leftbar.php');?>
<?php } ?>
<!-- Header End -->