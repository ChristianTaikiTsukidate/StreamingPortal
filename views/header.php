<?php
require_once('../controller/config.php');
function createHeader($description, $keywords, $title, $shouldBeUncrawlable) { ?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="description"
          content="<?= $description ?>">
    <meta name="keywords"
          content="<?= $keywords ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php if($shouldBeUncrawlable) { ?>
        <meta name="robots" content="noindex, nofollow">
        <?php } ?>
    <title><?= $title ?></title>
    <?php require_once("headerCSS.php") ?>
</head>
<body>
<?php require_once("headerNavbar.php"); ?>
<?php } ?>

