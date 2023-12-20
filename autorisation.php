<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
    include('includes_chant/testmodal.php');
    include('includes_chant/cobdd.php');
    require_once('includes_chant/dompdf/autoload.inc.php');
    $title = "Autorisation parentale";

if (!empty($_POST['nom'])&&!empty($_POST['prenom'])&&!empty($_POST['tel'])&&!empty($_POST['adresse'])&&!empty($_POST['mail'])&&!empty($_POST['datejour'])&&!empty($_POST['nomenf'])&&!empty($_POST['prenomenf'])&&!empty($_POST['datenaiss'])) 

{
$sql = "INSERT INTO `responsable`(`nom`, `prenom`, `telephone`, `adresse`, `email`, `datejour`, `nomenfant`, `prenomenfant`, `datenaissance`) VALUES (:nom, :prenom,:tele, :addre, :mail, :datej, :nomenfe, :prenomenfe, :datenaiss)";
$query = $db->prepare($sql);
$query->bindValue(':nom',$_POST['nom'], PDO::PARAM_STR);
$query->bindValue(':prenom',$_POST['prenom'], PDO::PARAM_STR);
$query->bindValue(':tele',$_POST['tel'], PDO::PARAM_STR);
$query->bindValue(':addre',$_POST['adresse'], PDO::PARAM_STR);
$query->bindValue(':mail',$_POST['mail'], PDO::PARAM_STR);
$query->bindValue(':datej',$_POST['datejour'], PDO::PARAM_STR);
$query->bindValue(':nomenfe',$_POST['nomenf'], PDO::PARAM_STR);
$query->bindValue(':prenomenfe',$_POST['prenomenf'], PDO::PARAM_STR);
$query->bindValue(':datenaiss',$_POST['datenaiss'], PDO::PARAM_STR);
$query->execute();
var_dump($query);
}

?>

<!DOCTYPE html>
<html lang="en">
    <?php
    include('includes_chant/head-html.php');
    ?>
<body>
    <div class="mx-3 px-3 d-flex">
        <img class="mx-3" src="images_chant/inscription.svg" alt="" width="3%">
        <h1 class="my-3">Autorisation parentale</h1><br>
    </div>
    <h3> Autorisation parentale</h3>
        <div class="container" id="autorisation">
            <form method="POST">
                <p class="autorisationp">
                    De participation aux concours de chant organisé par la mairie de Longuenesse pour un mineur.<br>
                    <input type="text" placeholder=" Adresse" name="adresse"><br>
                    <input type="text" placeholder=" Téléphone" name="tel" ><br>
                    <input type="text" placeholder=" Adresse email" name="mail" ><br>
                    <input type="date" name="datejour"><br> 
                        Madame, Monsieur, Je soussigné(e) Madame / Monsieur <br> 
                    <input type="text" placeholder="Nom" name="nom" ><br>
                    <input type="text" placeholder="Prénom" name="prenom" ><br>
        
                        Parent de l’enfant : <br>
                    <input type="text" placeholder=" Nom de l'enfant" name="nomenf">
                    <input type="text" placeholder=" Prénom de l'enfant" name="prenomenf">  
                    Née le : <input type="date" name="datenaiss"> <br>
                        ayant le plein exercice de l’autorité parentale l’autorise à : <br>
                    <li>Candidater aux concours de création étudiante</li>
                    <li>A recevoir directement le prix financier en cas de victoire</li>
                    <li>A participer à toutes les valorisations proposées dans le cadre du concours</li>
                    Je certifie : <br>
                    <li>Qu’il/elle a pris connaissance du règlement du règlement du concours auquel il/elle est inscrit(e) et déclare expressément en accepter toutes les conditions</li>
                </p>
            <button onclick="pdf.js" type="submit">Envoyer</button>
            </form>
        </div>
        
        <div class="fixed-bottom">
            <?php    
                include('includes_chant/footer_chant.php');
            ?>
        </div>
</body>
</html>