<?php
require_once("../models/connection.php");
require_once("../models/offers.php");
require_once("../models/movies.php");
require_once("../models/series.php");
require_once("../models/providers.php");
require_once("../models/seasons.php");
require_once("../models/genres.php");
$seasons = new Seasons();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['form_add_season'])) {
        echo $seasons->getLatestSeasonByOffersId($_GET['id'])['number'] + 1;
        $seasonId = $seasons->insertSeasonWithOffersIdAndNumber($seasons->getLatestSeasonByOffersId($_GET['id'])['number'] + 1, $_GET['id']);
        header('Location: EpisodeEditView.php?id=' . $_GET['id'] . "&seasonId=" . $seasonId);
    }
    if (isset($_POST["form_delete"])) {
        $offers = new Offers("offers");
        $offers->deleteOfferById($_GET['id']);
        header('Location: index.php');
    }
}

$seasonsArr = $seasons->getSeasonsByOffersIdFullInfo($_GET['id']);
$providers = new Providers();
$series = new Series();
$movies = new Movies();
$seriesArr = $series->getRecordById($_GET['id']);
$movieArr = $movies->getRecordById($_GET['id']);
$providersArr = $providers->getProvidersByOffersId($_GET['id']);
$media = [];
if (count($movieArr) > 0) {
    $media = array_merge($media, $movieArr[0]);
    $media['type'] = "Movie";
} else {
    $media = array_merge($media, $seriesArr[0]);
    $media['type'] = "Series";
}
$breadcrumbAssArr = array(
    "Home" => "index.php",
    $media['type'] => "MediaDetailsView.php?id=" . $_GET['id']
);
$genres = new Genres();
$genresArr = $genres->getGenreByOffersId($_GET['id']);

$offers = new offers("offers");
if(isset($_SESSION['userId'])) {
    $watchlist = $offers->getOfferByUserId($_SESSION["userId"]);
    $watchlist = $offers->convertAssArrToArr($watchlist, 'id');
}
?>

