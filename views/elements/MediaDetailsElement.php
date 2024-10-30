<?php
function createMediaDetailsElement($media, $providersArr, $title, $genresArr)
{
    global $watchlist
    ?>
    <section>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="anime__details__pic set-bg" data-setbg=<?= $media["posterLink"]; ?>>
                    <div class="comment"><i class="fa fa-comments"></i> 11</div>
                    <div class="view"><i class="fa fa-eye"></i> 9141</div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="anime__details__text">
                    <div class="anime__details__title">
                        <h1 style="font-size: 30px"><?= $title; ?></h1>
                        <span></span>
                    </div>
                    <div class="anime__details__rating">
                        <div class="rating">
                            <?php
                            $i = $media["rating"];
                            while ($i >= 1) { ?>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <?php
                                $i = $i - 1;
                            }
                            if ($i < 0.5 && $i > 0) { ?>
                                <a href="#"><i class="fa fa-star-half-o"></i></a>
                            <?php } else {
                                ?>
                                <a href="#"><i class="fa fa-star"></i></a>
                            <?php } ?>
                        </div>
                        <span>1.029 Votes</span>
                    </div>
                    <p><?= $media["description"]; ?></p>
                    <div class="anime__details__widget">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <ul>
                                    <li><span>Type:</span>
                                        <?=
                                        $media['type']
                                        ?>
                                    </li>
                                    <li><span>Studios:</span> Lerche</li>
                                    <li><span>Date aired:</span><?= $media["releaseYear"]; ?></li>
                                    <li><span>Status:</span> Airing</li>
                                    <li>
                                        <span>Genre:</span>
                                        <?php
                                        echo $genresArr[0];
                                        unset($genresArr[0]);
                                        foreach ($genresArr as $genre) {
                                            echo ", " . $genre;
                                        }
                                        ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <ul>
                                    <li><span>Scores:</span><?= $media["rating"]; ?> / 10</li>
                                    <li><span>Rating:</span><?= $media["rating"]; ?> / 10</li>
                                    <li><span>Duration:</span><?= $media["duration"]; ?> min</li>
                                    <li><span>Quality:</span> HD</li>
                                    <li><span>Views:</span> 131,541</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                            foreach ($providersArr as $provider) {
                                createStreamingServiceIcon($provider);
                            }
                            ?>
                        </div>
                    </div>
                    <div class="anime__details__btn">
                        <?php if (isset($_SESSION["email"])) {
                            if (isset($watchlist)) {
                                if (in_array($media['id'], $watchlist)) { ?>
                                    <a href="javascript:void(0)s" class="follow-btn" id="followBtn"><i
                                                class="fa fa-heart"></i>
                                        Follow</a>

                                <?php } else { ?>
                                    <a href="javascript:void(0)" class="follow-btn" id="followBtn"><i
                                                class="fa fa-heart-o"></i>
                                        Follow</a>
                                <?php } ?>
                                <input value="<?= $_GET['id']; ?>" id="followBtnValue" hidden>
                            <?php } ?>
                            <a href="#" class="watch-btn"><span>Watch Now</span> <i
                                        class="fa fa-angle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>