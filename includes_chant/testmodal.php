<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include("includes_chant/cobdd.php");
$title = "Connect";



if (!empty($_POST["mail"]) && !empty($_POST["mdp"]))
{
    $sql = "SELECT * FROM `user` WHERE `email` = :adresseMail";
    $query = $db->prepare($sql);
    $query->bindValue(":adresseMail", $_POST["mail"], PDO::PARAM_STR);
    $query->execute();
    $controleID = $query->fetch();
    // var_dump($controleID);
    $hash = $controleID["mdp"];
    // echo $hash;



    if ($controleID["email"] === $_POST["mail"] && password_verify($_POST['mdp'], $hash) === true)
    {
        session_start();
        $_SESSION["id"] = $controleID["prenom"];
        $_SESSION["nom"] = $controleID["nom"];
        $_SESSION["role"] = $controleID["role"];
        $_SESSION["facture"] = $controleID["id_user"];
        
    }
    else{
        echo('râté');
    }
  }

$sql = 'SELECT `role` FROM `user` WHERE `id_user`= :roles';
$query = $db->prepare($sql);
$query->bindValue(":roles",$_SESSION["role"], PDO::PARAM_STR);
$query->execute();

?>
<!DOCTYPE html>
<html lang="en">
    <?php require("includes_chant/head-html.php");?>
<body>
<div class="container d-flex">
      <img src="images_chant/logo1.svg" alt="Logo" width="" height="70" class="mt-2"> 
      <p id="textlogo" class="mx-5 mt-4">Harmonie Vocale: Éclatez-vous sur Scène avec notre Concours de Chant Exceptionnel!</p>
  </div>
  <nav class="navbar navbar-inverse navbar-global pb-3">
    <div class="container">
        <div class="navbar-header">
            <img src="images_chant/home.svg" alt="">
            <a class="navbar-brand" href="index.php"><button type="button" class="btn btn">Page d'accueil</button></a>
        </div>
        <?php
        if ($_SESSION["role"]==="candidat") {
           echo('<div class="navbar-header">
           <img src="images_chant/suivi.svg" alt="">
           <a class="navbar-brand" href="suivi.php"><button type="button" class="btn btn">Suivi du dossier</button></a>
       </div>');
        }
        elseif ($_SESSION["role"]==="admin"){
           echo('<div class="navbar-header">
           <a class="navbar-brand" href="admin.php"><button type="button" class="btn btn">Administration</button></a>
       </div>'); 
        }
        else {
            
        }
        ?>
        <?php
        if (empty($_SESSION["id"])) {
            echo('<div class="navbar-header">
                 <img src="images_chant/inscription.svg" alt="">
                <a class="navbar-brand" href="inscription.php"><button type="button" class="btn btn">Inscription</button></a>
                </div>
                <div class="navbar-header">
            <img src="images_chant/connexion.svg" alt="">
            <button id="openmodal" type="button" class="btn btn" >connexion</button>
        </div>');
        }
        else {
            echo('<div class="navbar-header">
                    <a class="navbar-brand" href="includes_chant/deconnexion.php"><button type="button" class="btn btn">Déconnexion</button></a>
                    </div>');
        }
        ?>
    </div>
    <dialog id="modal" class="divco">
        <button id="close" type="button" class="btn-close" aria-label="Close"></button>
            <h1>connexion</h1>
        <form id="connexion" method="POST">
            <div class="my-3">
                <input type="text" class="input-group-text" name="mail" placeholder="Adresse-mail">
            </div>
            <div class="my-3" id="test">
                <input type="password" class="input-group-text" id="password3" name="mdp" placeholder="Mot de passe">
                <div class="password-icon">
                    <i class="password-icon" data-feather="eye" id ="oeil1"></i>
                    <i class="password-icon" data-feather="eye-off" id="pasoeil1"></i>
                </div>
                <script src="https://unpkg.com/feather-icons"></script>
                <script>
                feather.replace();
                </script>
            </div>
            <div id="btnmodal" class="d-flex" >
                <button class="btn btn-primary" id="co" type="submit">Connexion</button>
            </div>
        </form>
        </dialog>
</nav>
</body>

</html>