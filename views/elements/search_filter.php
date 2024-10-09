<form action="/StreamingPortal/index.php" method="post" >
    <input type="hidden" name="form_identifier" value="filterForm">
    <div class="product__page__title">
        <div class="row">
            <div class="col-10" id="filters">
                <?php
                require_once("models/connection.php");
                require_once("models/offers.php");
                require_once("models/genres.php");
                require_once("views/filter_dropdowns.php");
                require_once("models/providers.php");
                require_once("models/actors.php");
                require_once("models/directors.php");
                $genreConn = new genres();
                createDropdown($genreConn->getGenres(), "Genres");
                $offerz = new offers("offers");
                createDropdown($offerz->getReleaseYear(), "Release Year");
                createDropdown($offerz->getRatings(), "Ratings");
                $providers = new providers();
                createDropdown($providers->getProviderNames(), "Streaming Service");
                $actors = new actors();
                createDropdown($actors->getActorNames(), "Actors");
                $directors = new directors();
                createDropdown($directors->getDirectorNames(), "Directors");
                createDropdown(["Series", "Movies"], "Media");
                ?>
                <div id="noFilterNotification">
                    Bitte einen Suchfilter setzen!
                </div>
            </div>
            <div class="col-10" id="selectedFilters">
            </div>
            <div class="col-1">
                <button class="btn btn-danger" id="filterButton" type="button">Hide</button>
            </div>
            <div class="col-1">
                <button class="btn btn-danger" id="searchButton" type="submit">Search</button>
            </div>
        </div>
    </div>
    <input id="filterResult" name="filterResult" value="" type="hidden">
</form>

<?php