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
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Update</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="genreTBody">
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</section>
<script src="fetchData.js"></script>
<?php
require_once('footer.php');
?>

