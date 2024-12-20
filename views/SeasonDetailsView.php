<?php
/** @var int $seasonsCount */
/** @var array $providersArr */
/** @var array $episodesArr */
/** @var array $season */
/** @var array $breadcrumbAssArr */
/** @var array $genresArr */
require_once('header.php');
require_once('elements/breadcrumb.php');
require_once("elements/StreamingServiceIcon.php");
require_once("elements/MediaElements.php");
require_once("elements/MediaDetailsElement.php");
require_once('../controller/SeasonDetailsController.php');
require_once ("elements/createMetadata_Season.php");
$description = createDescriptionSeason($season['title'], $season['number']);
$keywords = createKeywordsSeason($season['title'], $season['number']);
$title = createTitleSeason($season['title'], $season['number']);
createHeader($description,$keywords,$title, false);
createBreadcrumb($breadcrumbAssArr);
createMediaDetailsElement($season, $providersArr, $season["title"] . ": Season " . $season['number'], $genresArr) ?>
<div class="container">
    <div class="product__page__title">
        <div class="row">
            <?php if ($_SESSION['role'] == "admin") { ?>
                <a href="EpisodeEditView.php?id=<?= $_GET['id'] ?>&seasonId=<?= $_GET['seasonId'] ?>"
                   class="btn btn-info btn-lg">
                    <span class="glyphicon glyphicon-edit"></span>Add Episode
                </a>
                <?php if ($seasonsCount > 1) { ?>
                    <form method="post"
                          action="SeasonDetailsView.php?id=<?= $_GET['id']; ?>&seasonId=<?= $_GET['seasonId'] ?>">
                        <button type="submit" class="btn btn-info btn-lg"
                                name="seasonDelete" id="deleteBtn">Delete
                        </button>
                    </form>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="product__page__content">
                    <div class="row">
                        <?php
                        foreach ($episodesArr as $episode) {
                            createMediaElement($episode, "EpisodeDetailsView.php?id=" . $episode["id"] . "&seasonId=" . $episode["seasonId"] . "&episodeId=" . $episode["episodeId"], $episode["name"], false);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="js/custom/deleteBtn.js"></script>
<?php require_once('footer.php'); ?>