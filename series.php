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
    border-bottom:black solid 2px;
}

h2 {
    margin-bottom: -15px;
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

<HTML>
<head>
</head>

<body>

<a href="http://localhost/index.php">Vorige pagina</a>

<?php
$stmt = $pdo->prepare("SELECT titel, rating, omschrijving, seizoenen, landVanAfkomst, taal, awards, id FROM netland.inhoud WHERE id=? AND soort='series'");
$stmt->execute([$_GET['id']]);
while ($info = $stmt->fetch()) {
    echo("<h1>" . $info['titel'] . "</h1><br><b>rating </b>" . $info["rating"] . "</b><br><b>Land van afkomst </b>" . $info["landVanAfkomst"] . "<br><b>Taal </b>" . $info["taal"] .
    "<br><b>Seizoenen </b>" . $info["seizoenen"] . "<br><br><b>Beschrijving </b><br>" . $info["omschrijving"] . "<br><br><b>Aantal prijzen gewonnen </b>" . $info["awards"] . "<br><br
    ><a href=http://localhost/seriesOverlord.php?id=$info[id]>Edit</a>");
}


?>


