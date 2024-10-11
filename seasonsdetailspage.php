<?php require_once('header.php'); ?>
    <!-- Breadcrumb Begin -->
<?php require_once('views/elements/breadcrumb.php');
require_once("views/elements/movieelement.php");
require_once("./models/connection.php");
require_once("models/offers.php");
require_once("models/movies.php");
require_once("models/series.php");
require_once("models/genres.php");
require_once("models/providers.php");
require_once("models/actors.php");
require_once("models/directors.php");
require_once("models/seasons.php");
require_once("models/episodes.php");
$seasons = new Seasons();
$season = $seasons->getSeasonById($_GET['seasonId']);
$episodes = new Episodes();
if(isset($_POST['addEpisode'])) {
    $episodes->insertEpsisodeWithSeasonId();
    $seasons = $_POST["seasonsId"];
}
$episodesArr = $episodes->getEpisodesBySeasonId($_GET['seasonId']);
$providers = new Providers();
$seasonsCount = $seasons->getSeasonsCountByOffersId($_GET['id']);
if(isset($_POST["form_editor"])) {
    if ($_POST['form_editor'] === 'Edit') {
       // $seasons =
    }
}

$series = new Series();
$seriesArr = $series->getRecordById($_GET['id']);
$providersArr = $providers->getProvidersByOffersId($_GET['id']);
$media = [];
$media = array_merge($media, $seriesArr[0]);
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
                            <?php if(isset($_SESSION['adminlogin'])) {?>
                                <a href="episodeeditpage.php?id=<?= $_GET['id'] ?>&seasonId=<?= $_GET['seasonId'] ?>" class="btn btn-info btn-lg">
                                    <span class="glyphicon glyphicon-edit"></span>Add Episode
                                </a>
                                <?php if($seasonsCount > 1) { ?>
                                <form method="post" action="anime-details.php?id=<?php echo $media["id"]; ?>">
                                    <button type="submit" class="btn btn-info btn-lg" value="<?= $_GET['seasonId'] ?>" name="seasonDelete" id="deleteBtn">Delete</button>
                                </form>
                            <?php }
                            }?>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3><?php echo $media["title"]; ?>: Season <?php echo $media["number"]; ?></h3>
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
                                    <?php if(in_array("Netflix", $providersArr)){ ?>
                                        <div class="col"><img alt="Netflix" title="Netflix"
                                                              src="https://www.justwatch.com/images/icon/207360008/s100/netflix.{format}"
                                                              class="streamingService"></div>
                                    <?php } ?>

                                    <?php if(in_array("Amazon Prime", $providersArr)){ ?>
                                        <div class="col"><img alt="Amazon Prime Video"
                                                              title="Amazon Prime Video"
                                                              src="https://www.justwatch.com/images/icon/52449539/s100/amazonprime.{format}"
                                                              class="streamingService"></div>
                                    <?php } ?>

                                    <?php if(in_array("Disney+", $providersArr)){ ?>
                                        <div class="col"><img data-v-2da73ee6="" alt="Disney Plus"
                                                              title="Disney Plus"
                                                              src="https://www.justwatch.com/images/icon/313118777/s100/disneyplus.{format}"
                                                              class="streamingService"></div>
                                    <?php } ?>

                                    <?php if(in_array("Apple TV+", $providersArr)){ ?>
                                        <div class="col"><img data-v-2da73ee6="" alt="Apple TV Plus"
                                                              title="Apple TV Plus"
                                                              src="https://www.justwatch.com/images/icon/152862153/s100/appletvplus.{format}"
                                                              class="streamingService"></div>
                                    <?php } ?>

                                    <?php if(in_array("HBO Max", $providersArr)){ ?>
                                        <div class="col"><img data-v-2da73ee6="" alt="HBO Max"
                                                              title="HBO Max"
                                                              src="img/StreamingService/hbomax.jpg"
                                                              class="streamingService" style="width: 100px;height: 100px"></div>
                                    <?php } ?>

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
        </div>
    </section>
    <!-- Product Section Begin -->
    <section class="product-page spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__page__content">
                        <div class="row">
                        <?php
                        foreach ($episodesArr as $episode) {
                            createEpisodesElement($media, $season, $episode);
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