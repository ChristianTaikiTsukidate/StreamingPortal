<?php
function createBreadcrumb($breadcrumbAssArr)
{ ?>
    <div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <?php foreach ($breadcrumbAssArr as $innerHtml => $href) { ?>
                        <a href=<?= $href; ?>><i class="fa fa-home"></i><?= $innerHtml; ?></a>
                    <?php } ?>

                    <!--                    <span>Romance</span>-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>