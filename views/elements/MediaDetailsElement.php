<?php
function createMediaDetailsElement($media, $providersArr, $title)
{ ?>
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
                                <h3><?= $title; ?></h3>
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
                                    if ($i > 0.5) { ?>
                                        <a href="#"><i class="fa fa-star-half-o"></i></a>
                                    <?php }
                                    ?>
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
                                            <li><span>Genre:</span><?= $media["genre"]; ?></li>
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
                                <a href="#" class="follow-btn"><i class="fa fa-heart-o"></i> Follow</a>
                                <a href="#" class="watch-btn"><span>Watch Now</span> <i
                                            class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php } ?>