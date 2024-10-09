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