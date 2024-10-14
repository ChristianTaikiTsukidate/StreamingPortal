<?php
require_once("../controller/config.php");
require_once("../models/connection.php");
require_once("../models/offers.php");
require_once("../models/movies.php");
require_once("../models/series.php");
require_once("../models/genres.php");

$series = new Series();
$movies = new Movies();
$seriesArr = $series->getRecordById($_GET['id']);
$movieArr = $movies->getRecordById($_GET['id']);
$media = [];
if (count($movieArr) > 0) {
    $media = array_merge($media, $movieArr[0]);
    $media['type'] = "Movie";
} else {
    $media = array_merge($media, $seriesArr[0]);
    $media['type'] = "Series";
}
$genres = new Genres();
$genresArr = $genres->getGenreByOffersId($_GET['id']);
$media['genres'] = $genresArr;
echo json_encode($media);