<?php
require_once('elements/breadcrumb.php');
require_once("elements/MediaElements.php");
require_once("elements/StreamingServiceIcon.php");
require_once("elements/MediaDetailsElement.php");
require_once('header.php');
require_once ('elements/createMetaData_Media.php');
require_once("../controller/MediaDetailsController.php");
/** @var array $media */
/** @var array $seasonsArr */
/** @var array $providersArr */
/** @var array $breadcrumbAssArr */
/** @var array $genresArr */
$description = createDescriptionMedia($media['title'], $media['type']);
$keywords = createKeywordsMedia($media['title'], $media['genre'], $media['type']);
$title = createTitleMedia($media['title']);
createHeader($description,$keywords,$title,false);

createBreadcrumb($breadcrumbAssArr);
createMediaDetailsElement($media, $providersArr, $media['title'], $genresArr);
?>
    <div class="container">
        <div class="product__page__title">
            <div class="row">
                <?php if ($_SESSION['role'] == "admin") { ?>
                    <a href="MediaEditView.php?id=<?= $_GET['id'] ?>" class="btn btn-info btn-lg">
                        <span class="glyphicon glyphicon-edit"></span> Edit
                    </a>
                    <?php if ($media['type'] == 'Series') { ?>
                        <form method="post" action="MediaDetailsView.php?id=<?= $_GET['id']; ?>">
                            <button type="submit" class="btn btn-info btn-lg" value="<?= $_GET['id'] ?>"
                                    name="form_add_season" id="addSeason">Add Season
                            </button>
                        </form>
                        <?php
                    } ?>
                    <form method="post" action="MediaDetailsView.php?id=<?= $_GET['id']; ?>">
                        <button type="submit" class="btn btn-info btn-lg"
                                name="form_delete" id="deleteBtn">Delete
                        </button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
    </section>
    <!-- Product Section Begin -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__page__content">
                        <div class="row">
                            <?php
                            foreach ($seasonsArr as $season) {
                                createMediaElement($season, "SeasonDetailsView.php?id=" . $season["id"] . "&seasonId=" . $season["seasonId"], $season["title"] . ": Season " . $season["number"], false);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
    <script src="js/custom/deleteBtn.js"></script>
    <script src="addFavsDetails.js"></script>
<?php require_once('footer.php'); ?>