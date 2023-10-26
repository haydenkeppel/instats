<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Your Spotify Stats presented in the form of Instagram DMs"> <!--What the Site is-->
    <meta name="author" content="Hayden Keppel"> <!--Your Name-->
    <title>Instats</title> <!--Title of page (First half then second half) (Tab name)-->
    <link rel="stylesheet" type="text/css" href="css/style.css" /> <!--Stylesheet Link-->
    <script src="https://kit.fontawesome.com/a4f3d1faa5.js" crossorigin="anonymous"></script>
</head>
<body onload="onPageLoad()">
    <?php 
        require "config.php";
        if(isset($_SESSION['status'])) {
            echo $_SESSION['status'];
            unset($_SESSION['status']);
        }

        $DATA_PROFILE = callApi("GET", $PROFILE, null);

        $url = str_replace("{type}", "tracks", $TOP);
        $DATA_TOP10_TRACKS_long_term = callApi("GET", $url, "?time_range=long_term&limit=10");
        $DATA_TOP10_TRACKS_medium_term = callApi("GET", $url, "?time_range=medium_term&limit=10");
        $DATA_TOP10_TRACKS_short_term = callApi("GET", $url, "?time_range=short_term&limit=10");

        $DATA_TOP50_TRACKS_long_term = callApi("GET", $url, "?time_range=long_term&limit=50");
        $DATA_TOP50_TRACKS_medium_term = callApi("GET", $url, "?time_range=medium_term&limit=50");
        $DATA_TOP50_TRACKS_short_term = callApi("GET", $url, "?time_range=short_term&limit=50");

    ?>
    
    <div class="options">
        <select name="time_range" id="time_range_selector" onchange="optionChange()">
            <option value="short">4 Weeks</option>
            <option value="medium">6 Months</option>
            <option value="long">All Time</option>
        </select>
        <select name="amount" id="amount_selector" onchange="optionChange()">
            <option value="10">Top 10</option>
            <option value="50">Top 50</option>
        </select>
    </div>

    <!-- DISPLAY -->
    <div class="display">
        <div class="nav-bar">
            <div class="left">
                <img class="back-arrow" src="assets/left-arrow-white.svg">
                <h1 class="display-name">
                    <span id="display-name">Instats</span>
                </h1>
            </div>
            <div class="nav-bar-actions">
                <img src="assets/video-camera-plus-white.svg">
                <img src="assets/new-message-white.svg">
            </div>
        </div> <!-- .nav-bar -->
        <div class="search-section">
            <div class="search-bar">
                <img src="assets/search-icon.svg">
                <div class="text">
                    <span>Search...</span>
                    <span id="data_type">(<span id="limit">Top 10</span>, <span id="time_range">All Time</span>)</span>
                </div>
            </div>
        </div>
        <div class="top-bar">
            <span class="messages">Messages</span>
            <span class="requests">Requests</span>
        </div>
        <ul class="dms-list" id="dms-list">
            <!-- CONTENT GOES HERE -->
            <li class="dm">
                <div class="left">
                    <div class="profile-photo">
                        <img class="profile-img" id="profile-image" src="assets/empty-pfp.jpg">
                    </div>
                    <div class="message">
                        <p class="artist" id="artist">Instats</p>
                        <p><span class="song" id="song">Wait here to get your results!</span><span class="rank">&nbsp;⋅&nbsp;1m</span></p>
                    </div>
                </div>
                <div class="right">
                    <img src="assets/camera-white.svg">
                </div>
            </li>
        </ul>
        <div class="footer-section">
            <span>To view your spotify stats, visit:</span>
            <a href="https://instats-cc9e7eba17fa.herokuapp.com">https://instats-cc9e7eba17fa.herokuapp.com</a>
        </div>
    </div>

    <script src="app.js"></script>
    <script>
            localStorage.setItem('DATA_PROFILE', `<?php echo $DATA_PROFILE ?>`);
            localStorage.setItem('DATA_TOP10_TRACKS_long_term', `<?php echo $DATA_TOP10_TRACKS_long_term ?>`);
            localStorage.setItem('DATA_TOP10_TRACKS_medium_term', `<?php echo $DATA_TOP10_TRACKS_medium_term ?>`);
            localStorage.setItem('DATA_TOP10_TRACKS_short_term', `<?php echo $DATA_TOP10_TRACKS_short_term ?>`);
            localStorage.setItem('DATA_TOP50_TRACKS_long_term', `<?php echo $DATA_TOP50_TRACKS_long_term ?>`);
            localStorage.setItem('DATA_TOP50_TRACKS_medium_term', `<?php echo $DATA_TOP50_TRACKS_medium_term ?>`);
            localStorage.setItem('DATA_TOP50_TRACKS_short_term', `<?php echo $DATA_TOP50_TRACKS_short_term ?>`);
    </script>
</body>
</html>