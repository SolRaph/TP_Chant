<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include("includes_chant/cobdd.php");
$title = "Page d'accueil";
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <?php require("includes_chant/head-html.php");?>
<body>
    <?php require("includes_chant/testmodal.php");?>
    <div class="back" width="10%"></div>
<div class="d-flex">
        <img class="mx-3" src="images_chant/home.svg" alt="" width="3%">
        <p class="my-3" id="titreacc" ><u>Accueil</u></p>        
</div>
<?php
if (!empty($_SESSION["id"])) {echo('<div class="salut"><h1>salut '.$_SESSION["id"].'</h1></div>');}?>
    
<div class="container">
    <div class="d-flex">
        <div id="long" class="col md-7">
            <img id="photochato" class="mx-5 my-5" src="images_chant/chateau.png" alt="photo mairie Longuenesse">
            <div class="d-flex">
                <img id="logolongue" class="mx-3 my-3" src="images_chant/longuenesse-logo 1.png" alt="" height="100rem">
                <p>         Cette année, c’est la ville de Longuenesse qui accueille le concours de chant organisé par le collectif d’offices de tourisme de l’Audomarois. Ville en constant développement culturel et événementiel, c’est tout naturellement que le concours s’y déroulera. Les différents employés de la mairie de Longuenesse participeront au bon déroulé du concours. Organisateurs, techniciens et secrétaires s’occuperont de la gestion des différentes étapes de validation des candidatures. </p>
                
            </div>
        </div>
        <div id="infos" class="col md-3 mx-5">
             <img id="logoinfos" src="images_chant/attention.svg" alt="" width="30em" height="30em" ><u><strong> Informations</strong></u>
             <p>Le projet a été organisé dans le but de mettre en avant de la scène les talents de la région Audomaroise. Chaque candidat enverra son bulletin d’inscription, en y renseignant le titre de la chanson qu’il désirera chanter, et la bande son correspondante. Toute personne ayant un âge inférieur à 16 ans ne pourra pas participer au concours. Seul les participants ayant minimum 16 ans pourront participer. Les mineurs de 16 à 18 ans devront fournir un justificatif parental. Le tarif d’inscription est de 10 euros. Les candidats sélectionnés seront évalués devant un jury qui déterminera le vainqueur du concours qui remportera la somme de 2000 euros, le candidat en deuxième place remportera 100 euros. Et tout candidat ayant participé aux auditions devant les jurés remportera un bon d’achat de 10 euros à Auchan.</p>           
        </div>

    </div>
</div>
    <div>
    <?php require("includes_chant/footer_chant.php");?>
    </div>
</body>

</html>