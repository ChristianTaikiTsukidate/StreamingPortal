<?php
function createMediaElement($media, $href, $title, $enableWatchlist)
{
    global $watchlist;
    ?>
    <div class="col-lg-3 col-md-4 col-sm-6 customContainer product__item">
<div class="product__item__pic set-bg image" data-setbg=<?= $media["posterLink"]; ?>>
    <div class="ep"></i><?= $media["rating"]; ?> / 10</div>
    <div class="comment"><i class=""></i><?= $media["releaseYear"]; ?></div>
    <?php if (isset($_SESSION["email"]) && $enableWatchlist) {
    if (in_array($media['id'], $watchlist)) { ?>
        <button value="<?= $media['id']?>" class="favBtn"><div class="view"><i class="fa fa-heart"></i></div></button>
    <?php } else { ?>
        <button value="<?= $media['id']?>" class="favBtn"><div class="view"><i class="fa fa-heart-o"></i></div></button>
        <?php }
    }?>
        <div class="middle">
            <div class="text"><?= $media["description"]; ?>
            </div>
        </div>
        </div>
        <div class="product__item__text">
            <ul>
                <li><?= $media["fsk"]; ?></li>
            </ul>
            <h5><a href=<?= $href ?>><?= $title ?></a></h5>
        </div>
        </div>
    <?php } ?>
    <?php
