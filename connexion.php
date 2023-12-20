<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
    include('includes_chant/cobdd.php');
    $title = "Facture";
    session_start();
    echo($_SESSION["facture"]);
    ?>

<!DOCTYPE html>
<html lang="en">
<?php
include('includes_chant/head-html.php');
?>
</html>