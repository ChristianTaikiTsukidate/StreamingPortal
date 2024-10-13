<?php
require_once("../models/connection.php");
require_once("../models/offers.php");
require_once("../models/genres.php");
require_once("../models/providers.php");
require_once("../models/seasons.php");
require_once("../models/episodes.php");
$episodes = new Episodes();
if(isset($_GET['episodeId'])){
    $episode = $episodes->getEpisodeById($_GET['episodeId']);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['addEpisode'])) {
        $episodeId = $episodes->insertEpsisodeWithSeasonId();
        header('Location: EpisodeDetailsView.php?id=' . $_GET['id'] . '&seasonId=' . $_GET['seasonId'] . "&episodeId=" . $episodeId);
    }
    if (isset($_POST['editEpisode'])) {
        $episodes->updateEpisodeById($_GET['episodeId']);
        header('Location: EpisodeDetailsView.php?id=' . $_GET['id'] . '&seasonId=' . $_GET['seasonId'] . "&episodeId=" . $_GET['episodeId']);
    }
}


$latestEpisode = $episodes->getLatestEpisode($_GET['seasonId']);
$latestEpisodeNumber = $latestEpisode['number'] ?? 1;
$nextId = $episodes->getLatestId();