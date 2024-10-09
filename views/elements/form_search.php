<form action="/StreamingPortal/index.php" method="post">
    <div class="product__page__title">
        <div class="row">
            <div class="col-10" id="filters">
                <div class="dropdown">
                    <button class="btn dropdown-toggle dropdownbtn" type="button" type="button">Genre</button>
                    <div class="dropdown-content filterDropdown" id="genreFilter">
                        <input type="text" placeholder="Search.." class="filterInput">
                        <a class="filterOption">Action</a>
                        <a class="filterOption">Comedy</a>
                        <a class="filterOption">Horror</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="btn dropdown-toggle dropdownbtn" type="button">Release Date</button>
                    <div class="dropdown-content filterDropdown" id="releaseDateFilter">
                        <input type="text" placeholder="Search.." class="filterInput">
                        <a class="filterOption">2022</a>
                        <a class="filterOption">2023</a>
                        <a class="filterOption">2024</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="btn dropdown-toggle dropdownbtn" type="button">Rating</button>
                    <div class="dropdown-content filterDropdown" id="ratingFilter">
                        <input type="text" placeholder="Search.." class="filterInput">
                        <a class="filterOption">1</a>
                        <a class="filterOption">2</a>
                        <a class="filterOption">3</a>
                        <a class="filterOption">4</a>
                        <a class="filterOption">5</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="btn dropdown-toggle dropdownbtn" type="button">Streaming Service</button>
                    <div class="dropdown-content filterDropdown" id="streamingServiceFilter">
                        <input type="text" placeholder="Search.." class="filterInput">
                        <a class="filterOption">Netflix</a>
                        <a class="filterOption">Disney Plus</a>
                        <a class="filterOption">Amazon Prime</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="btn dropdown-toggle dropdownbtn" type="button">Actor</button>
                    <div class="dropdown-content filterDropdown" id="actorFilter">
                        <input type="text" placeholder="Search.." class="filterInput">
                        <a class="filterOption">a</a>
                        <a class="filterOption">b</a>
                        <a class="filterOption">c</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="btn dropdown-toggle dropdownbtn" type="button">Director</button>
                    <div class="dropdown-content filterDropdown" id="directorFilter">
                        <input type="text" placeholder="Search.." class="filterInput">
                        <a class="filterOption">a</a>
                        <a class="filterOption">b</a>
                        <a class="filterOption">c</a>
                    </div>
                </div>
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
</form>

<?php