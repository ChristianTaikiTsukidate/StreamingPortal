<?php
/** @var Genres $genres */
/** @var Offers $offers */
/** @var Providers $providers */
/** @var Actors $actors */
/** @var Directors $directors */
/** @var array $medias */
/** @var array $breadcrumbAssArr */
require_once('header.php');
require_once('../controller/IndexController.php');
require_once('elements/breadcrumb.php');
createBreadcrumb($breadcrumbAssArr);
require_once('elements/carousel.php');
require_once('elements/filterDropdowns.php');
require_once('elements/MediaElements.php');
echo DBUSER;

?>
<!-- Carousel End -->
<!-- Product Section Begin -->
<section class="product-page spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="product__page__content">
                    <form action="/StreamingPortal/index.php" method="post">
                        <input type="hidden" name="form_identifier" value="filterForm">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-10" id="filters">
                                    <?php
                                    createFilterDropdown($genres->getGenres(), "Genres");
                                    createFilterDropdown($offers->getReleaseYear(), "Release Year");
                                    createFilterDropdown($offers->getRatings(), "Ratings");
                                    createFilterDropdown($providers->getProviderNames(), "Streaming Service");
                                    createFilterDropdown($actors->getActorNames(), "Actors");
                                    createFilterDropdown($directors->getDirectorNames(), "Directors");
                                    createFilterDropdown(["Series", "Movies"], "Media");
                                    ?>
                                    <div id="noFilterNotification">
                                        Bitte einen Suchfilter setzen!
                                    </div>
                                </div>
                                <div class="col-10" id="selectedFilters">
                                </div>
                                <div class="col-1">
                                    <button class="btn btn-danger" id="filterButton" type="button">Hide</button>
                                </div>
                                <div class="col-1">
                                    <button class="btn btn-danger" id="searchButton" type="submit">Search</button>
                                </div>
                            </div>
                        </div>
                        <input id="filterResult" name="filterResult" value="" type="hidden">
                    </form>
                    <div class="row">
                        <?php
                        foreach ($medias as $media) {
                            createMediaElement($media, "MediaDetailsView.php?id=" . $media["id"], $media["title"]);
                        }
                        ?>
                    </div>
                </div>
                <?php require_once('elements/pagination.php') ?>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->
<?php require_once('footer.php'); ?>
