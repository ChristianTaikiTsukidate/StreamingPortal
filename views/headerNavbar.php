<!-- Header Section Begin -->
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="header__logo">
                    <a href="index.php">
                        <img src="img/logo.png" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="header__nav">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li><a href="index.php">Homepage</a></li>
                            <li>
                                <button id="backgroundbutton" style="all: unset; cursor: pointer;">Background</button>
                            </li>
                            <?php
                            if ($_SESSION['role'] == "admin") { ?>
                                <li><a href="MediaEditView.php">Add Movie/Series</a></li>
                                <li><a href="#">API<span class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">
                                        <li><a href="APIView.php?endpoint=Genre">Genres</a></li>
                                        <li><a href="APIView.php?endpoint=Provider">Providers</a></li>
                                        <li><a href="APIView.php?endpoint=FilmIndustryProfessional">FilmIndustryProfessional</a></li>
                                        <li><a href="APIView.php?endpoint=Language">Language</a></li>
                                    </ul>
                                </li>
                            <?php }?>
                            <?php
                            if (isset($_SESSION['email'])) { ?>
                                <li><a href="WatchListView.php">Watchlist</a></li>
                                <li><a href="logout.php">Logout</a></li>
                            <?php } if(!isset($_SESSION['email'])) { ?>
                                <li><a href="login.php">Login</a></li>
                            <?php } ?>

                        </ul>
                    </nav>
                </div>
            </div>
            <div class="input-group col align-bottom align-items-center col-lg-4">
                <input type="text" class="form-control" placeholder="Search" id="searchField"/>
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header>
<!-- Header End -->