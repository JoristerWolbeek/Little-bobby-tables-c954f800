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

input {
    border-radius: 5px;
    height: 30px;
}

.hoofd {
    display: flex;
    width: 60%;
    height: 80%;
    border: solid 2px #4a94bd;
    flex-direction: column;
    align-self: center;
    align-items: center;
    align-self: auto;
    align-items: auto;
    padding: 30px;

}

.hHoofd {
    justify-content: center;
    display: flex;
    justify-content: center;
    width: 100%;
    height: 100%;
}

.sub {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: row;
    line-height: 50px;
    justify-content: space-between;
    padding: 15px
}
.subDif {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: row;
    line-height: 50px;
    justify-content: center;
    padding: 15px
}

button {
    color: white;
    background-color: #4a94bd;
    border: black;
    border-radius: 5px;
}

textarea {
    border-radius: 5px;
}



</style>


<HTML>
<head>`
</head>`
<body>

    <?php
    $stmt = $pdo->prepare("SELECT titel, rating, omschrijving, duur, landVanAfkomst, taal, trailer, id FROM netland.inhoud WHERE id=? AND soort='movies'");
    $stmt->execute([intval($_GET["id"])]);
    $info = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <a href="http://localhost/films.php<?php echo "?id=$info[id]" ?>">Vorige pagina</a>
    <div class="hHoofd">
        <form method="post" class="hoofd">
            <div class="sub"><b>Titel </b><input required type="text" name="name" value="<?php echo $info['titel']?>"></div>
            <div class="sub"><b>Lengte </b><input required type="number" name="duur" value="<?php echo $info['duur']?>"></div>
            <div class="sub"><b>Land van afkomst </b><input required type="text" name="landVanAfkomst" value="<?php echo $info['landVanAfkomst']?>"></div>
            <div class="sub"><b>Beschrijving </b><textarea required type="text" name="beschrijving" rows="15" cols="40"> <?php echo $info['omschrijving']?> </textarea></div>
            <div class="sub"><b>Taal </b><input type="text" name="taal" value="<?php echo $info['taal']?>"></div>
            <div class="sub"><b>Trailer link </b><input type="text" name="trailer" value="<?php echo $info['trailer']?>"></div>
            <div class="subDif"><button type="sumbit">Veranderen</button</div>
        </form>
    </div>
<?php
if (
    isset($_POST["name"]) || isset($_POST["duur"]) || isset($_POST["beschrijving"]) || isset($_POST["landVanAfkomst"])
        || isset($_POST["trailer"]) || isset($_POST["uitkomstDatum"])
) {
    $updateMovies = $pdo->prepare("UPDATE inhoud SET titel=?, omschrijving=?, landVanAfkomst=?, duur=?, trailer=?, taal=? WHERE id=? AND soort='movies'");
    $updateMovies->execute([$_POST["name"], $_POST["beschrijving"], $_POST["landVanAfkomst"], $_POST["duur"], $_POST["trailer"], $_POST["taal"],  $_GET["id"]]);
    header("Refresh:0");
}
?>

</body>
</HTML>
