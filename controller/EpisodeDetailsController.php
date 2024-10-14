<?php
require_once("../models/connection.php");
require_once("../models/providers.php");
require_once("../models/episodes.php");
require_once("../models/genres.php");
$breadcrumbAssArr = array(
    "Home" => "index.php",
    "Series" => "MediaDetailsView.php?id=" . $_GET['id'],
    "Season" => "SeasonDetailsView.php?id=" . $_GET['id'] . "&seasonId=" . $_GET['seasonId'],
    "Episode" => "EpisodeDetailsView.php?id=" . $_GET['id'] . "&seasonId=" . $_GET['seasonId'] . "&episodeId=" . $_GET['episodeId']
);
$providers = new Providers();
$providersArr = $providers->getProvidersByOffersId($_GET['id']);
$episodes = new Episodes();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["episodeDelete"])) {
        $episodes->deleteEpisodeById($_GET['episodeId']);
        header('Location: SeasonDetailsView.php?id=' . $_GET['id'] . "&seasonId=" . $_GET['seasonId']);
    }
}
$episodesCount = $episodes->getEpisodeNumbers($_GET['seasonId']);
$episode = $episodes->getEpisodeById($_GET['episodeId']);
$episode['type'] = "Series";

$genres = new Genres();
$genresArr = $genres->getGenreByOffersId($_GET['id']);

