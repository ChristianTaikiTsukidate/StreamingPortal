<?php
require_once('header.php');
require_once('views/elements/inputformfield.php');
require_once('views/elements/multiselect.php');
require_once("models/connection.php");
require_once("models/offers.php");
require_once("models/genres.php");
require_once("models/providers.php");
require_once("models/seasons.php");
require_once("models/episodes.php");
$episodes = new Episodes();
if(isset($_GET['episodeId'])){
    $episode = $episodes->getEpisodesById($_GET['episodeId'])[0];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['form_adder'])) {
        $offers = new Offers("offers");
        $offersId = $offers->insertGetId();
        $genres = new Genres();
        $genres->insertOffersHasGenresById($offersId);
        $providers = new Providers();
        $providers->insertOffersHasProvidersById($offersId);
        $seasons = new Seasons();
        $seasonsId = $seasons->insertSeasonWithOffersId($offersId);
    }
}
$latestEpisode = $episodes->getLatestEpisode($_GET['seasonId']);
$latestEpisodeNumber = $latestEpisode['number'] ?? 1;
$nextId = $episodes->getLatestId();
?>
<!-- Product Section Begin -->
<section class="product-page spad">
    <div class="container" id="movieEditForm">
        <form method="post" action="seasonsdetailspage.php?id=<?= $_GET['id'] ?>&seasonId=<?= $_GET['seasonId'] ?>">
            <div class="row">
            <?php if(!isset($_GET['episodeId'])){ ?>
                <input type="hidden" id="episodenumber" name="episodenumber" value="<?php echo $latestEpisode['number'] ?? 1; ?>">
                <?php
                createinputformfield("Name","", "text");
                createinputformfield("Release Year", "", "number");
                createinputformfield("Duration", "", "number");
                } else { ?>
                    <input type="hidden" id="episodenumber" name="episodenumber" value="<?php echo $episode['number']; ?>">
                <?php
                    createinputformfield("Name",$episode['name'], "text");
                    createinputformfield("Release Year", $episode['releaseYear'], "number");
                    createinputformfield("Duration", $episode['duration'], "number");
                     } ?>
            </div>
            <input type="hidden" id="seasonId" name="seasonId" value="<?php echo $_GET['seasonId']; ?>">
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary" name="addEpisode">Add</button>
                </div>
            </div>
        </form>
    </div>
</section>
<script src="js/custom/formvalidation.js"></script>
<?php
require_once('footer.php');
?>

