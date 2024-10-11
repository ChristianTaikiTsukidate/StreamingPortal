<?php
function createMovieElement($media) { ?>
            <div class="col-lg-3 col-md-4 col-sm-6 customContainer product__item">
        <div class="product__item__pic set-bg image" data-setbg=<?php echo $media["posterLink"]; ?>>
            <div class="ep"></i><?php echo $media["rating"]; ?> / 10</div>
            <div class="comment"><i class=""></i><?php echo $media["releaseYear"]; ?></div>
            <div class="middle">
                <div class="text"><?php echo $media["description"]; ?>
                </div>
            </div>
        </div>
        <div class="product__item__text">
            <ul>
                <li><?php echo $media["fsk"]; ?></li>
            </ul>
            <h5><a href="anime-details.php?id=<?php echo $media["id"]; ?>"><?php echo $media["title"]; ?></a></h5>
        </div>
    </div>
<?php } ?>
<?php
    function createSeriesElement($media, $season) { ?>
    <div class="col-lg-3 col-md-4 col-sm-6 customContainer product__item">
        <div class="product__item__pic set-bg image" data-setbg=<?php echo $media["posterLink"]; ?>>
            <div class="ep"></i><?php echo $season["number"]; ?> / 10</div>
            <div class="comment"><i class=""></i><?php echo $media["releaseYear"]; ?></div>
            <div class="middle">
                <div class="text"><?php echo $media["description"]; ?>
                </div>
            </div>
        </div>
        <div class="product__item__text">
            <ul>
                <li><?php echo $media["fsk"]; ?></li>
            </ul>
            <h5><a href="seasonsdetailspage.php?id=<?php echo $media["id"] . "&seasonId=" . $season["id"]; ?>"><?php echo $media["title"]; ?></a></h5>
        </div>
    </div>
<?php } ?>
<?php
function createEpisodesElement($media, $season, $episode) { ?>
    <div class="col-lg-3 col-md-4 col-sm-6 customContainer product__item">
        <div class="product__item__pic set-bg image" data-setbg=<?php echo $media["posterLink"]; ?>>
            <div class="ep"></i><?php echo $season["number"]; ?></div>
            <div class="comment"><i class=""></i><?php echo $media["releaseYear"]; ?></div>
            <div class="middle">
                <div class="text"><?php echo $media["description"]; ?>
                </div>
            </div>
        </div>
        <div class="product__item__text">
            <ul>
                <li><?php echo $media["fsk"]; ?></li>
            </ul>
            <h5><a href="episodedetailspage.php?id=<?php echo $media["id"] . "&seasonId=" . $season["id"] . "&episodeId=" . $episode["id"]; ?>"><?php echo $episode["name"]; ?></a></h5>
        </div>
    </div>
<?php } ?>
