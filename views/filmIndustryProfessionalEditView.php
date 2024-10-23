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
                        <input type="text" class="form-control" name="firstName" placeholder="Enter First Name">
                    </div>
                    <div class="form-group col-3">
                        <input type="text" class="form-control" name="lastName" placeholder="Enter Last Name">
                    </div>
                    <button type="javascript:void(0);" class="btn btn-primary col-3" id="addBtn">Submit</button>
                </form>
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
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
<script src="fetchFilmIndustryProfessional.js"></script>
<?php
require_once('footer.php');
?>

