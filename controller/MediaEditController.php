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
$connection = new Connection("");
print_r($_POST);
if (isset($_GET['id'])) {
    $seriesArr = $series->getRecordById($_GET['id']);
    $moviesArr = $movies->getRecordById($_GET['id']);
    if (count($moviesArr) > 0) {
        $media = array_merge($media, $moviesArr[0]);
    } else {
        $media = array_merge($media, $seriesArr[0]);
    }
    $genresArr = $genres->getGenreByOffersId($_GET['id']);
    $providersArr = $connection->convertAssArrToArr($providers->getProvidersByOffersId($_GET['id']), "provider");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = $connection->getPdo();

        $pdo->exec("SET TRANSACTION ISOLATION LEVEL SERIALIZABLE");

        $pdo->beginTransaction();  // Start transaction here

        $offers = new Offers("offers");
        $offersId = $offers->insertGetId();
        $genres = new Genres();
        $genres->insertOffersHasGenresById($offersId);

        $providers = new Providers();
        $providers->insertOffersHasProvidersById($offersId);

        if (isset($_POST['form_adder'])) {
            if ($_POST['form_adder'] === 'Movie') {
                $movies = new Movies();  // Ensure Movies is instantiated
                $movies->insertMovieWithOffersId($offersId);
            } elseif ($_POST['form_adder'] === 'Series') {
                $seasons = new Seasons();
                $seasonsId = $seasons->insertSeasonWithOffersId($offersId);
            }
        }

        $pdo->commit();  // Commit transaction

        // Redirect after commit
        if(isset($_POST['form_adder'])) {
            if ($_POST['form_adder'] === 'Movie') {
                header('Location: MediaDetailsView.php?id=' . $offersId);
            } elseif ($_POST['form_adder'] === 'Series') {
                header('Location: EpisodeEditView.php?id=' . $offersId . "&seasonId=" . $seasonsId);
            }
        }
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Failed: " . $e->getMessage();
    }
    if (isset($_POST["mediaEdit"])) {
        if ($_POST['mediaEdit'] === 'Edit') {
            try {
                $pdo = $connection->getPdo();

                $pdo->exec("SET TRANSACTION ISOLATION LEVEL READ UNCOMMITTED");

                $pdo->beginTransaction();  // Start transaction here

                $offers = new Offers("offers");
                $offers->updateById($_GET['id']);
                $genres = new Genres();
                $genres->updateOffersHasGenresById($_GET['id']);
                $providers->updateOffersHasProvidersById($_GET['id']);
                print_r($moviesArr);
                if (count($moviesArr) > 0) {
                    print_r("HHHHFAFAHFDHASFHFSDHFSDHFD");
                    $movies = new Movies();
                    $movies->updateMovieByOffersId($_GET['id']);
                }
                $pdo->commit();  // Commit transaction
                header('Location: MediaDetailsView.php?id=' . $_GET['id']);
            } catch (Exception $e) {
                $pdo->rollBack();
                echo "Failed: " . $e->getMessage();
            }
        }
    }
}
