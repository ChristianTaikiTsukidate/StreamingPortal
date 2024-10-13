<?php
require_once('elements/inputformfield.php');
require_once('elements/multiselect.php');
require_once("../models/connection.php");
require_once("../models/offers.php");
require_once("../models/genres.php");
require_once("../models/providers.php");
require_once("../models/movies.php");
require_once("../models/series.php");
require_once("../models/seasons.php");
$media = [];
$genres = new Genres();
$seriesArr = [];
$moviesArr = [];
$providers = new providers();
$series = new Series();
$movies = new Movies();

if (isset($_GET['id'])) {
    $seriesArr = $series->getRecordById($_GET['id']);
    $moviesArr = $movies->getRecordById($_GET['id']);
    if (count($moviesArr) > 0) {
        $media = array_merge($media, $moviesArr[0]);
    } else {
        $media = array_merge($media, $seriesArr[0]);
    }
    $genresArr = $genres->getGenreByOffersId($_GET['id']);
    $connection = new Connection("");
    $providersArr = $connection->convertAssArrToArr($providers->getProvidersByOffersId($_GET['id']), "provider");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['form_adder'])) {
        $offers = new Offers("offers");
        $offersId = $offers->insertGetId();
        $genres = new Genres();
        $genres->insertOffersHasGenresById($offersId);
        $providers = new Providers();
        $providers->insertOffersHasProvidersById($offersId);
        if ($_POST['form_adder'] === 'Movie') {
            $movies->insertMovieWithOffersId($offersId);
            header('Location: MediaDetailsView.php?id=' . $offersId);
        }
        if($_POST['form_adder'] === 'Series') {
            $seasons = new Seasons();
            $seasonsId = $seasons->insertSeasonWithOffersId($offersId);
            header('Location: EpisodeEditView.php?id=' . $offersId . "&seasonId=" . $seasonsId);
        }
    }
    if(isset($_POST["mediaEdit"])) {
        if ($_POST['mediaEdit'] === 'Edit') {
            $offers = new Offers("offers");
            $offers->updateById($_GET['id']);
            $genres = new Genres();
            $genres->updateOffersHasGenresById($_GET['id']);
            $providers->updateOffersHasProvidersById($_GET['id']);
            if($moviesArr > 0) {
                $movies = new Movies();
                $movies->updateMovieByOffersId($_GET['id']);
            }
            header('Location: MediaDetailsView.php?id=' . $_GET['id']);
        }
    }
}
