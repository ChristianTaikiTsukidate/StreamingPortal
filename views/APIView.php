<?php
require_once('header.php');
createHeader("","","", true);
?>
<!-- Product Section Begin -->
<section class="product-page spad">

    <div class="container" id="movieEditForm">
        <h2 class="text-center" id="headerTwo"></h2>
        <form method="post">
            <div class="row">
                <table class="table table-dark">
                    <thead>
                    <tr id="fetchHeader">
                    </tr>
                    </thead>
                    <tbody id="fetchBody">
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let endpoint = "http://localhost:5081/api/<?= $_GET['endpoint']?>";
        document.getElementById('headerTwo').innerHTML = "<?= $_GET['endpoint']?>";
        generateAPITable(endpoint);
    });
</script>
<script src="fetchAPIObject.js">
</script>
<?php
require_once('footer.php');
?>

