<?php
require_once('header.php');
require_once('views/elements/inputformfield.php');
require_once('views/elements/multiselect.php');
require_once("models/connection.php");
require_once("models/offers.php");
require_once("models/genres.php");
require_once("models/providers.php");
require_once("models/movies.php");
require_once("models/series.php");
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
    $providersArr = $providers->getProvidersByOffersId($_GET['id']);
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
        }
    }
}
?>
<!-- Product Section Begin -->
<section class="product-page spad">
    <div class="container" id="movieEditForm">

        <?php
        if (isset($_GET['id'])) {
        ?>
        <form method="post" action="anime-details.php?id=<?php echo $_GET['id']; ?>"><?php
            }         else {
            ?>
            <button type="button" class="btn btn-primary" id="seriesMovieButton">Series</button>
            <form method="post" action="movieedit.php" id="addingForm"><?php
                }
                ?>
                <div class="row">
                    <?php
                    createinputformfield("Title", $media['title'] ?? "", "text");
                    createinputformfield("Original Title", $media['originalTitle'] ?? "", "text");
                    ?>
                </div>
                <div class="row">
                    <?php
                    createMultiselect($genres->getGenres(), "Genres", $genresArr ?? [""]);
                    createMultiselect($providers->getProviderNames(), "Streaming Services", $providersArr ?? [""]);
                    ?>
                </div>
                <div class="row">
                    <?php
                    createinputformfield("Poster Link", $media['posterLink'] ?? "", "text");
                    createinputformfield("Trailer", $media['trailer'] ?? "", "text");
                    ?>
                </div>
                <div class="row">
                    <?php
                    createinputformfieldMinMax("Rating", $media['rating'] ?? "", "number", 0, 10, ".01");
                    createinputformfield("FSK", $media['fsk'] ?? "", "number");
                    ?>
                </div>
                <div class="row" id="movieSpecifics">
                    <?php
                    createinputformfield("Release Year", $media['releaseYear'] ?? "", "number");
                    createinputformfield("Duration", $media['duration'] ?? "", "number");
                    ?>
                </div>
                <div class="row">
                    <?php
                    createinputformfield("Description", $media['description'] ?? "", "textarea");
                    ?>
                </div>
                <?php
                if (isset($_GET['id'])) {
                    ?>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary" value="Edit" name="form_editor">Edit</button>
                        </div>
                        <?php if(count($seriesArr) > 0) ?>
                        <div class="col">
                            <button type="button" class="btn btn-primary" value="AddSeason">Add Season</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-primary" value="AddEpisode">Add Episode</button>
                        </div>
                        <?php ?>
                    </div>
                    <?php
                } else {
                    ?>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-primary" value="Movie" name="form_adder" id="submitMedia">Submit</button>
                            </div>
                            <div class="col seriesBtn">
                                <button type="button" class="btn btn-primary" value="AddSeason">Add Season</button>
                            </div>
                            <div class="col seriesBtn">
                                <button type="button" class="btn btn-primary" value="AddEpisode">Add Episode</button>
                            </div>
                        </div>
                    <?php
                }
                ?>

            </form>
    </div>
</section>
<script src="js/custom/formvalidation.js"></script>
<script src="js/custom/movieSeries.js"></script>
<?php
require_once('footer.php');
?>

