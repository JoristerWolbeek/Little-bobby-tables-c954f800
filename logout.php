<?php
if (isset($_POST["logout"])) {
    setcookie("loggedInUser", "", time() - 2 * 24 * 60 * 60);
    header("location: index.php");
}