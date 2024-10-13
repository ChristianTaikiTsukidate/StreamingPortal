<?php
    function createMediaElement($season, $href, $title) { ?>
    <div class="col-lg-3 col-md-4 col-sm-6 customContainer product__item">
        <div class="product__item__pic set-bg image" data-setbg=<?= $season["posterLink"]; ?>>
            <div class="ep"></i><?= $season["rating"]; ?> / 10</div>
            <div class="comment"><i class=""></i><?= $season["releaseYear"]; ?></div>
            <div class="middle">
                <div class="text"><?= $season["description"]; ?>
                </div>
            </div>
        </div>
        <div class="product__item__text">
            <ul>
                <li><?= $season["fsk"]; ?></li>
            </ul>
            <h5><a href=<?= $href ?>><?= $title ?></a></h5>
        </div>
    </div>
<?php } ?>
<?php
