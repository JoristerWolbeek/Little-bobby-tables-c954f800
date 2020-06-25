<?php
session_start();
$servername = "mysql:host=localhost;dbname=netland";
$username = "root";
$password = "";
$pdo = new PDO($servername, $username, $password);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <div class="loginbox">
        <form method="post">
        <input type="text" placeholder="name" name="name" require>
        <input type="password" placeholder="Password" name="password" require>
        <button type="sumbit">Log in</button>
    </div>
</body>
</html>


<?php
if (isset($_POST["name"]) || isset($_POST["password"])) {
    $nameIn = $_POST['name'];
    $wachtwoordIn = $_POST['password'];
    // ingevulde wachtwoord en naam van gebruiker
    $log = $pdo->query("SELECT naam, wachtwoord, id FROM netland.gebruikers WHERE naam='$nameIn'");
    $inlogPremit = $log->fetch();
    if (!empty($inlogPremit['naam'])) {
        if ($nameIn == $inlogPremit['naam'] && $wachtwoordIn == $inlogPremit['wachtwoord']) {
            setcookie("loggedInUser", $nameIn, time() + 2 * 24 * 60 * 60);
            header("location: index.php");
            //kijkt of de naam klopt me die geven met een email in database, hetzelfde voor wachtwoord
        }
    } else {
        echo "wachtwoord of gebruikersnaam klopt niet" ;
    }
}
    //Hier wordt daadwerkelijk ingelogd
?>
