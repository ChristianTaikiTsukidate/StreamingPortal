<?php
require_once('header.php');
require_once('elements/breadcrumb.php');
require_once("elements/MediaElements.php");
require_once("elements/StreamingServiceIcon.php");
require_once("elements/MediaDetailsElement.php");
require_once("../controller/MediaDetailsController.php");
/** @var array $media */
/** @var array $seasonsArr */
/** @var array $providersArr */
?>

<?php createMediaDetailsElement($media, $providersArr, $media['title']) ?>
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
                                createMediaElement($season, "SeasonDetailsView.php?id=" . $season["offerId"] . "&seasonId=" . $season["seasonId"], $season["title"] . ": Season " . $season["number"]);
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
<?php require_once('footer.php'); ?>