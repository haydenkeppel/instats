<?php
    require "config.php";

    $url = $AUTHORIZE;
    $url .= "?client_id=${CLIENT_ID}";
    $url .= "&response_type=code";
    $url .= "&redirect_uri=" . encodeURI($redirect_uri);
    $url .= "&show_dialog=true";
    $url .= "&scope=user-top-read user-read-email";
    header("Location: ".$url);