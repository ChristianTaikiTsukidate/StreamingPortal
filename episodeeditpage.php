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
    } if(isset($_POST['addEpisode'])) {
        $episodes->insertEpsisodeWithSeasonId();
        $seasons = $_POST["seasonsId"];
    }
}
echo $seasonsId;
$latestEpisode = $episodes->getLatestEpisode($seasonsId);
?>
<!-- Product Section Begin -->
<section class="product-page spad">
    <div class="container" id="movieEditForm">
        <form method="post" action="episodeeditpage.php">
            <div class="row">
                <?php
                createinputformfield("Number", (isset($latestEpisode['number']) ? $latestEpisode['number'] + 1 : 1), "number");
                createinputformfield("Name", $latestEpisode['name'] ?? "", "text");
                ?>
            </div>
            <div class="row">
                <?php
                createinputformfield("Release Year", $latestEpisode['releaseYear'] ?? "", "number");
                createinputformfield("Duration", $latestEpisode['duration'] ?? "", "number");
                ?>
            </div>
            <input type="hidden" id="seasonsId" name="seasonsId" value="<?php echo $seasonsId; ?>">
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

