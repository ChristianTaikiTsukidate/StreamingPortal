<?php
/** @var Genres $genres */
/** @var Offers $offers */
/** @var Providers $providers */
/** @var Actors $actors */
/** @var Directors $directors */
/** @var array $medias */
/** @var array $breadcrumbAssArr */
/** @var array $watchlist */
require_once('../controller/config.php');
require_once('header.php');
createHeader("","","", true);
require_once('../controller/WatchListController.php');
require_once('elements/MediaElements.php');

?>
<!-- Carousel End -->
<!-- Product Section Begin -->
<section class="product-page spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="product__page__content">
                    <div class="row">
                        <?php
                        foreach ($medias as $media) {
                            if(in_array($media['id'], $watchlist)){
                                createMediaElement($media, "MediaDetailsView.php?id=" . $media["id"], $media["title"], true);
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php require_once('elements/pagination.php') ?>
            </div>
        </div>
    </div>
</section>
<script src="addFavsWatchlist.js"></script>
<script src="hoverDetails.js"></script>
<!-- Product Section End -->
<?php require_once('footer.php'); ?>
