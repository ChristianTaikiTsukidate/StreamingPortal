<?php
require_once('header.php');
require_once('elements/inputformfield.php');
require_once('elements/multiselect.php');
require_once("../controller/EpisodeEditController.php");
/** @var array $latestEpisode */
/** @var array $episode */
?>
<!-- Product Section Begin -->
<section class="product-page spad">
    <div class="container" id="movieEditForm">
        <form method="post">
            <div class="row">
                <?php if (!isset($_GET['episodeId'])) { ?>
                    <input type="hidden" id="episodenumber" name="episodenumber"
                           value="<?php echo $latestEpisode['number'] ?? 1; ?>">
                    <?php
                    createinputformfield("Name", "", "text");
                    createinputformfield("Release Year", "", "number");
                    createinputformfield("Duration", "", "number");
                } else { ?>
                    <?php
                    createinputformfield("Name", $episode['name'], "text");
                    createinputformfield("Release Year", $episode['releaseYear'], "number");
                    createinputformfield("Duration", $episode['duration'], "number");
                } ?>
            </div>
            <input type="hidden" id="seasonId" name="seasonId" value="<?php echo $_GET['seasonId']; ?>">
            <div class="row">
                <div class="col">
                    <?php if (isset($_GET['episodeId'])) {
                    ?>
                    <button type="submit" class="btn btn-primary" name="editEpisode">Edit</button>
                    <?php } else {?>
                        <button type="submit" class="btn btn-primary" name="addEpisode">Add</button>
                    <?php } ?>

                </div>
            </div>
        </form>
    </div>
</section>
<script src="js/custom/formvalidation.js"></script>
<?php
require_once('footer.php');
?>

