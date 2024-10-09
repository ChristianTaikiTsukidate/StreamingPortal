<?php require_once('header.php'); ?>
    <!-- Breadcrumb Begin -->
<?php require_once('views/elements/breadcrumb.php'); ?>
<?php
require_once("./models/connection.php");
require_once("models/offers.php");
require_once("models/movies.php");
require_once("models/series.php");
require_once("models/genres.php");
require_once("models/providers.php");
require_once("models/actors.php");
require_once("models/directors.php");
if(isset($_POST["form_editor"])) {
    if ($_POST['form_editor'] === 'Edit') {
        $offers = new Offers("offers");
        $offers->updateById($_GET['id']);
        $genres = new Genres();
        $genres->updateOffersHasGenresById($_GET['id']);
        $providers = new Providers();
        $providers->updateOffersHasProvidersById($_GET['id']);
        $movies = new Movies();
        $movies->updateMovieByOffersId($_GET['id']);
        print_r($_POST);
    }
}
$series = new Series();
$movies = new Movies();
$seriesArr = $series->getRecordById($_GET['id']);
$moviesArr = $movies->getRecordById($_GET['id']);
$media = [];
if(count($moviesArr) > 0){
    $media = array_merge($media, $moviesArr[0]);
} else {
    $media = array_merge($media, $seriesArr[0]);
}

?>
<!--     Anime Section Begin-->
    <section class="anime-details spad">
        <div class="container">
            <div class="anime__details__content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="anime__details__pic set-bg" data-setbg=<?php echo $media["posterLink"]; ?>>
                            <div class="comment"><i class="fa fa-comments"></i> 11</div>
                            <div class="view"><i class="fa fa-eye"></i> 9141</div>
                        </div>
                        <div class="row">
                                <a href="movieedit.php?id=<?= $_GET['id'] ?>" class="btn btn-info btn-lg">
                                    <span class="glyphicon glyphicon-edit"></span> Edit
                                </a>
                                <form method="post" action="index.php">
                                    <button type="submit" class="btn btn-info btn-lg" value="<?= $_GET['id'] ?>" name="form_delete" id="deleteBtn">Delete</button>
                                </form>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3><?php echo $media["title"]; ?></h3>
                                <span></span>
                            </div>
                            <div class="anime__details__rating">
                                <div class="rating">
                                    <?php
                                    $i = $media["rating"];
                                        while($i > 1) {?>
                                            <a href="#"><i class="fa fa-star"></i></a>
                                       <?php
                                        $i = $i - 1;
                                        }
                                        if($i > 0.5) { ?>
                                            <a href="#"><i class="fa fa-star-half-o"></i></a>
                                        <?php }
                                    ?>
                                </div>
                                <span>1.029 Votes</span>
                            </div>
                            <p><?php echo $media["description"]; ?></p>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Type:</span>
                                                <?php
                                                if(count($seriesArr)) {
                                                    echo "Series";
                                                } else {
                                                    echo "Movie";
                                                }
                                                ?>
                                            </li>
                                            <li><span>Studios:</span> Lerche</li>
                                            <li><span>Date aired:</span><?php echo $media["releaseYear"]; ?></li>
                                            <li><span>Status:</span> Airing</li>
                                            <li><span>Genre:</span><?php echo $media["genre"]; ?></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Scores:</span><?php echo $media["rating"]; ?> / 10</li>
                                            <li><span>Rating:</span><?php echo $media["rating"]; ?> / 10</li>
                                            <li><span>Duration:</span><?php echo $media["duration"]; ?> min</li>
                                            <li><span>Quality:</span> HD</li>
                                            <li><span>Views:</span> 131,541</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4"><img alt="Netflix" title="Netflix"
                                                                        src="https://www.justwatch.com/images/icon/207360008/s100/netflix.{format}"
                                                                        class="streamingService"></div>
                                    <div class="col-lg-4 col-md-4"><img alt="Amazon Prime Video"
                                                                        title="Amazon Prime Video"
                                                                        src="https://www.justwatch.com/images/icon/52449539/s100/amazonprime.{format}"
                                                                        class="streamingService"></div>
                                    <div class="col-lg-4 col-md-4"><img data-v-2da73ee6="" alt="Disney Plus"
                                                                        title="Disney Plus"
                                                                        src="https://www.justwatch.com/images/icon/313118777/s100/disneyplus.{format}"
                                                                        class="streamingService"></div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                                <a href="#" class="follow-btn"><i class="fa fa-heart-o"></i> Follow</a>
                                <a href="#" class="watch-btn"><span>Watch Now</span> <i
                                            class="fa fa-angle-right"></i></a>
                            </div>
                            <div class="login__social">
                                <div class="col-lg-6">
                                    <div class="login__social__links">
                                        <ul>
                                            <li><a href="#" class="facebook"><i class="fa fa-facebook"></i>Facebook</a>
                                            </li>
                                            <li><a href="#" class="google"><i class="fa fa-google"></i>Google</a></li>
                                            <li><a href="#" class="twitter"><i class="fa fa-twitter"></i>Twitter</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="anime__details__review">
                        <div class="section-title">
                            <h5>Reviews</h5>
                        </div>
                        <div class="anime__review__item">
                            <div class="anime__review__item__pic">
                                <img src="img/anime/review-1.jpg" alt="">
                            </div>
                            <div class="anime__review__item__text">
                                <h6>Chris Curry - <span>1 Hour ago</span></h6>
                                <p>whachikan Just noticed that someone categorized this as belonging to the genre
                                    "demons" LOL</p>
                            </div>
                        </div>
                        <div class="anime__review__item">
                            <div class="anime__review__item__pic">
                                <img src="img/anime/review-2.jpg" alt="">
                            </div>
                            <div class="anime__review__item__text">
                                <h6>Lewis Mann - <span>5 Hour ago</span></h6>
                                <p>Finally it came out ages ago</p>
                            </div>
                        </div>
                        <div class="anime__review__item">
                            <div class="anime__review__item__pic">
                                <img src="img/anime/review-3.jpg" alt="">
                            </div>
                            <div class="anime__review__item__text">
                                <h6>Louis Tyler - <span>20 Hour ago</span></h6>
                                <p>Where is the episode 15 ? Slow update! Tch</p>
                            </div>
                        </div>
                        <div class="anime__review__item">
                            <div class="anime__review__item__pic">
                                <img src="img/anime/review-4.jpg" alt="">
                            </div>
                            <div class="anime__review__item__text">
                                <h6>Chris Curry - <span>1 Hour ago</span></h6>
                                <p>whachikan Just noticed that someone categorized this as belonging to the genre
                                    "demons" LOL</p>
                            </div>
                        </div>
                        <div class="anime__review__item">
                            <div class="anime__review__item__pic">
                                <img src="img/anime/review-5.jpg" alt="">
                            </div>
                            <div class="anime__review__item__text">
                                <h6>Lewis Mann - <span>5 Hour ago</span></h6>
                                <p>Finally it came out ages ago</p>
                            </div>
                        </div>
                        <div class="anime__review__item">
                            <div class="anime__review__item__pic">
                                <img src="img/anime/review-6.jpg" alt="">
                            </div>
                            <div class="anime__review__item__text">
                                <h6>Louis Tyler - <span>20 Hour ago</span></h6>
                                <p>Where is the episode 15 ? Slow update! Tch</p>
                            </div>
                        </div>
                    </div>
                    <div class="anime__details__form">
                        <div class="section-title">
                            <h5>Your Comment</h5>
                        </div>
                        <form action="#">
                            <textarea placeholder="Your Comment"></textarea>
                            <button type="submit"><i class="fa fa-location-arrow"></i> Review</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="anime__details__sidebar">
                        <div class="section-title">
                            <h5>you might like...</h5>
                        </div>
                        <div class="product__sidebar__view__item set-bg" data-setbg="img/sidebar/tv-1.jpg">
                            <div class="ep">18 / ?</div>
                            <div class="view"><i class="fa fa-eye"></i> 9141</div>
                            <h5><a href="#">Boruto: Naruto next generations</a></h5>
                        </div>
                        <div class="product__sidebar__view__item set-bg" data-setbg="img/sidebar/tv-2.jpg">
                            <div class="ep">18 / ?</div>
                            <div class="view"><i class="fa fa-eye"></i> 9141</div>
                            <h5><a href="#">The Seven Deadly Sins: Wrath of the Gods</a></h5>
                        </div>
                        <div class="product__sidebar__view__item set-bg" data-setbg="img/sidebar/tv-3.jpg">
                            <div class="ep">18 / ?</div>
                            <div class="view"><i class="fa fa-eye"></i> 9141</div>
                            <h5><a href="#">Sword art online alicization war of underworld</a></h5>
                        </div>
                        <div class="product__sidebar__view__item set-bg" data-setbg="img/sidebar/tv-4.jpg">
                            <div class="ep">18 / ?</div>
                            <div class="view"><i class="fa fa-eye"></i> 9141</div>
                            <h5><a href="#">Fate/stay night: Heaven's Feel I. presage flower</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="js/custom/deleteBtn.js"></script>
<?php require_once('footer.php'); ?>