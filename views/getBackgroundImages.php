<?php
session_start();
$arr = scandir("img/background/");
foreach ($arr as $key => $element) {
    if ($element == "." || $element == "..") {
        unset($arr[$key]);
    }
}
if(count($arr) > $_SESSION["backgroundIndex"]) {
    $_SESSION["backgroundIndex"]  = $_SESSION["backgroundIndex"] + 1;
} else {
    $_SESSION["backgroundIndex"]  = 1;
}
print_r($arr[$_SESSION["backgroundIndex"]]);