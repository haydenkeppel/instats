<?php
session_start();

function encodeURI($uri) {
    $uri = str_replace("%", "%25", $uri);
    $uri = str_replace("^", "%5E", $uri);
    $uri = str_replace("[", "%5B", $uri);
    $uri = str_replace("]", "%5D", $uri);
    $uri = str_replace("{", "%7B", $uri);
    $uri = str_replace("}", "%7D", $uri);
    $uri = str_replace("|", "%7C", $uri);
    $uri = str_replace("\\", "%5C", $uri);
    $uri = str_replace("\"", "%22", $uri);
    $uri = str_replace(">", "%3E", $uri);
    $uri = str_replace("<", "%3C", $uri);
    $uri = str_replace("`", "%60", $uri);

    $uri = str_replace(" ", "%20", $uri);
    $uri = str_replace("_", " ", $uri);

    return $uri;
}

function callApi($method, $url, $body){
    $ch = curl_init();
    // Set cURL options
    // Set custom headers
    if(!(isset($_SESSION['token_array']['access_token']))) {
        header("Location: requestAuthorization.php");
    }

    $headers = array(
        "Content-Type: application/json",
        "Authorization: Bearer ".$_SESSION['token_array']['access_token'], // Add authorization headers if required
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    if(strtoupper($method) == "POST") {
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    } elseif (strtoupper($method) == "GET") {
        $url = $url.$body;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    } else {
        curl_close($ch);
        $_SESSION['status'] = "ERROR: Unknown method. Use GET, or POST";
        return "ERROR: Unknown method. Use GET, or POST";
    }
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response !== false) {
        // Return the response
        return $response;
    } else {
        $_SESSION['status'] = 'Failed to make request. Refresh and try again.';
        return $_SESSION['status'];
    }
}

$CLIENT_ID = "f81e388fff944d5a95703c8bf7344962";
$CLIENT_SECRET = "38677ae50169401da45bbd0726a743ba";

$redirect_uri = "https://instats-cc9e7eba17fa.herokuapp.com/redir";

$AUTHORIZE = "https://accounts.spotify.com/authorize";
$TOKEN = "https://accounts.spotify.com/api/token";

$PROFILE = "https://api.spotify.com/v1/me";
$TOP = "https://api.spotify.com/v1/me/top/{type}";
