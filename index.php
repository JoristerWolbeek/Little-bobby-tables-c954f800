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

html {
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

<?php
$rememberSort = "";
$rememberSort1 = "";
if (array_key_exists('serieTitle', $_GET)) {
    $rememberSort = "&serieTitle=title";
}

if (array_key_exists('serieRating', $_GET)) {
    $rememberSort = "&serieRating=rating";
}

if (array_key_exists('movieTitel', $_GET)) {
    $rememberSort1 = "&movieTitel=titel";
}

if (array_key_exists('movieDuration', $_GET)) {
    $rememberSort1 = "&movieDuration=duration";
}

$serieTitel = "index.php?serieTitle=";
$serieTitel .= "title";
$serieTitel .= $rememberSort1;

$serieRating = "index.php?serieRating=";
$serieRating .= "rating";
$serieRating .= $rememberSort1;

$movieTitel = "index.php?movieTitel=";
$movieTitel .= "titel";
$movieTitel .= $rememberSort;

$movieDuration = "index.php?movieDuration=";
$movieDuration .= "duration";
$movieDuration .= $rememberSort;

?>


<body>
    <h1>Welkom om het netland beheerderspaneel</h1>

    <table>
    <form method="post" action=logout.php>
        <button name="logout">logout</button>
    </form>
        <h2>Films</h2>
            <tr>
            <form action="index.php" method="get">
                <th>
                    <?php
                        echo ("<a href='$movieTitel'>Titel</a>");
                    ?>
                </th>
                <th>
                    <?php
                        echo ("<a href='$movieDuration'>Duration</a>");
                    ?>
                <th>Details</th>
            </form>
            </tr>
        <form action="films.php" method="get">
            <?php
            $stmt = "";
            if (isset($_GET["movieTitel"])) {
                if ($_GET["movieTitel"] == "titel") {
                    $stmt = $pdo->query('SELECT titel, duur, id FROM netland.inhoud ORDER BY titel WHERE soort="movies"');
                    while ($info = $stmt->fetch()) {
                        echo("<tr><td>" . $info['titel'] . "</td><td>" . $info['duur'] . "</td><td><a name='id' type='submit' href='http://localhost/films.php?id=$info[id]'>Details</a></td></tr>");
                    }
                }
            }
            if (isset($_GET["movieDuration"])) {
                if ($_GET["movieDuration"] == "duration") {
                    $stmt = $pdo->query('SELECT titel, duur, id FROM netland.inhoud ORDER BY duur WHERE soort="movies"');
                    while ($info = $stmt->fetch()) {
                        echo("<tr><td>" . $info['titel'] . "</td><td>" . $info['duur'] . "</td><td><a name='id' type='submit' href='http://localhost/films.php?id=$info[id]'>Details</a></td></tr>");
                    }
                } else {
                    $stmt = $pdo->query('SELECT titel, duur, id FROM netland.inhoud WHERE soort="movies"');
                    while ($info = $stmt->fetch()) {
                        echo("<tr><td>" . $info['titel'] . "</td><td>" . $info['duur'] . "</td><td><a name='id' type='submit' href='http://localhost/films.php?id=$info[id]'>Details</a></td></tr>");
                    }
                }
            }
            if ($stmt == "") {
                $stmt = $pdo->query('SELECT titel, duur, id FROM netland.inhoud WHERE soort="movies"');
                while ($info = $stmt->fetch()) {
                    echo("<tr><td>" . $info['titel'] . "</td><td>" . $info['duur'] . "</td><td><a name='id' type='submit' href='http://localhost/films.php?id=$info[id]'>Details</a></td></tr>");
                }
            }
            ?>
        </form>
    </table>
    <form method=post>
            <?php
            if (isset($_POST['makeFilm'])) {
                $createFilm = $pdo->query('INSERT INTO netland.inhoud (titel, duur, taal, landVanAfkomst, omschrijving, trailer, soort) VALUES ("0", 0, "0", "0", "0", "0,", "movies")');
                $createFilm->fetch();
                header("refresh:0");
            }
            ?>
        <button name="makeFilm">Record maken voor film</button>
        </form>
    <table>
        <h2>Serie</h2>
        <form action="index.php" method="get">
            <tr>
                <th>
                <?php
                echo("<a href='$serieTitel'>Titel</a>");
                ?>
                </th>
            <th>
                <?php
                echo("<a href='$serieRating'>Rating</a>");
                ?>
            </th>
            <th>Details</th>
            </tr>
        </form>
    <form action="series.php" method="get">
            <?php
            $stmt1 = "";
            if (isset($_GET["serieTitle"])) {
                if ($_GET["serieTitle"] == "title") {
                    $stmt1 = $pdo->query('SELECT title, rating, id FROM netland.inhoud ORDER BY title WHERE soort="series"');
                    while ($info = $stmt1->fetch()) {
                        echo("<tr><td>" . $info['title'] . "</td><td>" . $info['rating'] . "</td><td><a name='id' type='submit' href='http://localhost/series.php?id=$info[id]'>Details</a></td></tr>");
                    }
                }
            }
            if (isset($_GET["serieRating"])) {
                if ($_GET["serieRating"] == "rating") {
                    $stmt1 = $pdo->query('SELECT title, rating, id FROM netland.inhoud ORDER BY rating WHERE soort="series"');
                    while ($info = $stmt1->fetch()) {
                        echo("<tr><td>" . $info['title'] . "</td><td>" . $info['rating'] . "</td><td><a name='id' type='submit' href='http://localhost/series.php?id=$info[id]'>Details</a></td></tr>");
                    }
                }
            }
            if ($stmt1 == "") {
                $stmt1 = $pdo->query('SELECT titel, rating, id FROM netland.inhoud WHERE soort="series"');
                while ($info = $stmt1->fetch()) {
                    echo("<tr><td>" . $info['titel'] . "</td><td>" . $info['rating'] . "</td><td><a name='id' type='submit' href='http://localhost/series.php?id=$info[id]'>Details</a></td></tr>");
                }
            }
            ?>
        </form>

        
    </table>
    <form method=post>
            <?php
            if (isset($_POST['makeSerie'])) {
                $createSerie = $pdo->query('INSERT INTO inhoud (titel, rating, omschrijving, awards, seizoenen, landVanAfkomst, taal, soort) VALUES ("0", 0, "0", 0, 0, "0,", "0", "series")');
                $createSerie->fetch();
                header("refresh:0");
            }
            ?>
        <button name="makeSerie">Record maken voor serie</button>
        </form>

    

</body>

</HTML>

