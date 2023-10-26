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
</head>
<body>
    <?php 
        require "config.php";
        if(isset($_SESSION['status'])) {
            echo $_SESSION['status'];
            unset($_SESSION['status']);
        }
    ?>
    <div id="connect">
        <form action="requestAuthorization.php">
            <input type="submit" value="Connect Spotify">
        </form>
    </div>
</body>
</html>