<?php
require_once('header.php');
require_once('../controller/MediaEditController.php');
/** @var Genres $genres */
/** @var Providers $providers */
/** @var array $seriesArr */
if ($_SESSION['role'] = "admin") {
    ?>
    <!-- Product Section Begin -->
    <section class="product-page spad">
        <div class="container" id="movieEditForm">

            <?php
            if (isset($_GET['id'])) {
            ?>
            <form method="post" action="MediaEditView.php?id=<?php echo $_GET['id']; ?>"><?php
                }         else {
                ?>
                <button type="button" class="btn btn-primary" id="seriesMovieButton">Series</button>
                <form method="post" action="MediaEditView.php" id="addingForm"><?php
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
                        if(count($seriesArr) == 0) {
                            createinputformfield("Release Year", $media['releaseYear'] ?? "", "number");
                            createinputformfield("Duration", $media['duration'] ?? "", "number");
                        }
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
                                <button type="submit" class="btn btn-primary" value="Edit" name="mediaEdit">Edit
                                </button>
                            </div>
                        </div>
                        <?php
                    } else {
                    ?>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary" value="Movie" name="form_adder"
                                    id="submitMedia">Submit
                            </button>
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
} else {
    header('location:index.php');
}
?>

