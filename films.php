<?php
session_start();
$servername = "mysql:host=localhost;dbname=netland";
$username = "root";
$password = "";
$pdo = new PDO($servername, $username, $password);
if ($_COOKIE["loggedInUser"] != "Admin") {
    header("location: login.php");
}

?>


<style>
table, tr, td, th {
    padding: 20px;
    border-collapse: collapse;
}

table {
    margin-bottom: 50px;
}

tr {
    border-bottom: #888888 solid 2px;
}

h2 {
    margin-bottom: -15px;
}

iframe {
    width: 100%;
    height: 100%;
}

h2, h3{
    margin: 0px;
}

html{
    font-size: 25px;
    background-Color: #222222;
}

body {
    color: #888888;
}

a { 
    color: #4a94bd;
    text-decoration: none;
    font-size: 20px;
}


</style>

<html>
<body>

<a href="http://localhost/index.php">Vorige pagina</a>
<?php

$stmt = $pdo->prepare("SELECT titel, duur, landVanAfkomst, omschrijving, taal, trailer, id FROM netland.inhoud WHERE id=? AND soort='movies'");
$stmt->execute([$_GET['id']]);
while ($info = $stmt->fetch()) {
    echo("<h1>" . $info['titel'] . "</h1><br><b>" . $info["duur"] . " Minuten </b><br><b>Land van afkomst </b>" . $info["landVanAfkomst"] .
    "<br><br><b>Beschrijving </b><br>" . $info["omschrijving"] . "<br><br><b>Taal </b>" . $info["taal"] . "<br><a href=http://localhost/movieOverlord.php?id=$info[id]>Edit</a>
    <br><iframe src='https://www.youtube.com/embed/$info[trailer]'</iframe>");
}

?>
</body>
</html>
