<?php
require_once("../models/connection.php");
require_once("../models/offers.php");
require_once("../models/genres.php");
require_once("../models/providers.php");
require_once("../models/actors.php");
require_once("../models/directors.php");
require_once("../models/movies.php");
require_once("../models/series.php");

$movieConn = new movies();
$movies = [];
$seriesConn = new series();
$series = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['form_identifier'])) {
        if ($_POST['form_identifier'] === 'filterForm') {
            $formIdentifier = json_decode($_POST['filterResult'], true);
            echo in_array("Movies", $formIdentifier['mediafilter']);
            if (in_array("Movies", $formIdentifier['mediafilter'])) {
                $movies = $movieConn->getFilteredRecords($formIdentifier);
            }
            if (in_array("Series", $formIdentifier['mediafilter'])) {
                $series = $seriesConn->getFilteredRecords($formIdentifier);
            }
        }
    } else {
        $movies = $movieConn->getRecords();
        $series = $seriesConn->getRecords();
    }
} else {
    $movies = $movieConn->getRecords();
    $series = $seriesConn->getRecords();
}
$medias = [];
if (count($movies) > 0) {
    $medias = array_merge($medias, $movies);
}
if (count($series) > 0) {
    $medias = array_merge($medias, $series);
}

$genres = new genres();
$offers = new offers("offers");
$providers = new providers();
$actors = new actors();
$directors = new directors();

