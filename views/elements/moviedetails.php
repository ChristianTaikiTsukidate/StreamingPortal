<?php
require_once("./models/connection.php");
require_once("models/offers.php");
require_once("models/movies.php");
require_once("models/series.php");
require_once("models/genres.php");
require_once("models/providers.php");
require_once("models/actors.php");
require_once("models/directors.php");
$series = new Series();
$movies = new Movies();
$seriesArr = $series->getRecordById($_GET['id']);
$moviesArr = $movies->getRecordById($_GET['id']);
if(count($seriesArr)){

} else {
}
?>