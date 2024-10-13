<?php
require_once("../models/connection.php");
require_once("../models/offers.php");
require_once("../models/providers.php");
require_once("../models/seasons.php");
require_once("../models/episodes.php");

$seasons = new Seasons();
if(isset($_POST['seasonDelete'])) {
    $seasons->deleteSeasonById($_GET['seasonId']);
    header('Location: MediaDetailsView.php?id=' . $_GET['id']);
}
$season = $seasons->getSeasonById($_GET['seasonId']);
$season['type'] = "Series";
$seasonsCount = count($seasons->getSeasonsByOffersId($_GET['id']));

$episodes = new Episodes();
$episodesArr = $episodes->getEpisodesBySeasonId($_GET['seasonId']);

$providers = new Providers();
$providersArr = $providers->getProvidersByOffersId($_GET['id']);


?>