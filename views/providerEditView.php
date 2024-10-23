<?php
require_once('header.php');
require_once('elements/inputformfield.php');
require_once('elements/multiselect.php');
/** @var array $latestEpisode */
/** @var array $episode */
?>
<!-- Product Section Begin -->
<section class="product-page spad">
    <div class="container" id="movieEditForm">
        <form method="post">
            <div class="row">
                <form class="row">
                    <div class="form-group col-3">
                        <input type="text" class="form-control" name="name" placeholder="Enter name">
                    </div>
                    <div class="form-group col-3">
                        <input type="text" class="form-control" name="affiliateLink" placeholder="Enter Affiliate Link">
                    </div>
                    <div class="form-group col-3">
                        <input type="text" class="form-control" name="logo" placeholder="Enter Logo">
                    </div>
                    <button type="javascript:void(0);" class="btn btn-primary col-3" id="addBtn">Submit</button>
                </form>
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Affiliate Link</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Update</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="fetchBody">
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</section>
<script src="fetchProvider.js"></script>
<?php
require_once('footer.php');
?>

