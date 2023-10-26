<?php 
require 'config.php';

// Gets CODE and TOKENS

$_SESSION['code'] = $_GET['code'];
$code = $_SESSION['code'];

$body = "grant_type=authorization_code";
$body .= "&code=" . $code;
$body .= "&redirect_uri=" . encodeURI($redirect_uri);
$body .= "&client_id=" . $CLIENT_ID;
$body .= "&client_secret=" . $CLIENT_SECRET;

$ch = curl_init();
// Set cURL options
curl_setopt($ch, CURLOPT_URL, $TOKEN);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

if ($response !== false) {
    // Process the response
    $_SESSION['token_array'] = json_decode($response, true);
    header("Location: stats");

} else {
    $_SESSION['status'] = 'Failed to make request. Refresh and try again.';
    header("Location: index.php");
}

?>
