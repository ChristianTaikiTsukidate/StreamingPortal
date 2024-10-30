<?php
/** @var array $providersArr */
/** @var array $episode */
/** @var int $episodesCount */
/** @var array $breadcrumbAssArr */
/** @var array $genresArr */
require_once('header.php');
require_once('elements/breadcrumb.php');
require_once("elements/StreamingServiceIcon.php");
require_once("elements/MediaDetailsElement.php");
require_once("../controller/EpisodeDetailsController.php");
require_once ("elements/createMetadata_Episode.php");
$description = createDescriptionEpisode($episode['title'], $episode['seasonNumber'], $episode['name']);
$keywords = createKeywordsEpisode($episode['title'], $episode['seasonNumber'], $episode['episodeNumber']);
$title = createTitleEpisode($episode['title'], $episode['seasonNumber'], $episode['name']);
createHeader($description,$keywords,$title, false);
createBreadcrumb($breadcrumbAssArr);
createMediaDetailsElement($episode, $providersArr, $episode['name'], $genresArr);
?>
    <div class="container">
        <div class="product__page__title">
            <div class="row">
                <?php if ($_SESSION['role'] == "admin") { ?>
                    <a href="EpisodeEditView.php?id=<?= $_GET['id'] ?>&seasonId=<?= $_GET['seasonId'] ?>&episodeId=<?= $_GET['episodeId'] ?>"
                       class="btn btn-info btn-lg">
                        <span class="glyphicon glyphicon-edit"></span> Edit
                    </a>
                    <?php if ($episodesCount > 1) { ?>
                        <form method="post">
                            <button type="submit" class="btn btn-info btn-lg" name="episodeDelete"
                                    id="deleteBtn">Delete
                            </button>
                        </form>
                    <?php } ?>

                <?php } ?>
            </div>
        </div>
    </div>
    </section>
    <script src="js/custom/deleteBtn.js"></script>
<?php require_once('footer.php'); ?>