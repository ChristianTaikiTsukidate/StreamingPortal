<div class="row">
    <?php
    require_once("models/offers.php");
    require_once("models/movies.php");
    require_once("models/series.php");
    require_once("views/elements/movieelement.php");
    $movieConn = new movies();
    $movies = [];
    $seriesConn = new series();
    $series = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['form_identifier'])) {
            if ($_POST['form_identifier'] === 'filterForm') {
                $formIdentifier = json_decode($_POST['filterResult'], true);
                echo in_array("Movies", $formIdentifier['mediafilter']);
                if(in_array("Movies", $formIdentifier['mediafilter'])) {
                    $movies = $movieConn->getFilteredRecords($formIdentifier);
                }
                if(in_array("Series", $formIdentifier['mediafilter'])) {
                    $series = $seriesConn->getFilteredRecords($formIdentifier);
                }
            }
        } else {
            if(isset($_POST["form_delete"])){
                $offers = new Offers("offers");
                $offers->deleteOfferById($_POST["form_delete"]);
            }
            $movies = $movieConn->getRecords();
            $series = $seriesConn->getRecords();
        }
    }  else {
        $movies = $movieConn->getRecords();
        $series = $seriesConn->getRecords();
    }
    $medias = [];
    if(count($movies) > 0) {
        $medias = array_merge($medias, $movies);
    }
    if(count($series) > 0) {
        $medias = array_merge($medias, $series);
    }
    foreach ($medias as $media) {
        createMovieElement($media);
    }
    ?>
</div>
