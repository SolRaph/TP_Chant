<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

use FontLib\Table\Type\head;

include('includes_chant/cobdd.php');
$title = "Inscription";




if(!empty($_POST['nom'])&&!empty($_POST['prenom'])&&!empty($_POST['email'])&&!empty($_POST['mdp'])&&!empty($_POST['confirmer']))
    {
        if ($_POST['datenaiss']>='16') {
           
            $sql = 'SELECT * FROM `user` WHERE `email`= :mail';
            $query = $db->prepare($sql);
            $query->bindValue(":mail", $_POST['email'],PDO::PARAM_STR);
            $query->execute();
            $verifEmail = $query->fetch();

        if ($verifEmail === false) {
                   
            $hash = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
            $sql = "INSERT INTO `user`(`nom`, `prenom`,`datenaiss`, `email`, `mdp`, `role`, `nomres`, `prenomres`, `numres`) VALUES (:nom, :prenom, :datenai, :email, :mdp, :roles, :nomres, :prenomres, :numres)";
            $query = $db->prepare($sql);
            $query->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
            $query->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
            $query->bindValue(':datenai', $_POST['datenaiss'], PDO::PARAM_STR);
            $query->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
            $query->bindValue(':mdp', $hash, PDO::PARAM_STR);
            $query->bindValue(':roles', 'candidat', PDO::PARAM_STR);
            $query->bindValue(':nomres', ' ', PDO::PARAM_STR);
            $query->bindValue(':prenomres', ' ', PDO::PARAM_STR);
            $query->bindValue(':numres', ' ', PDO::PARAM_STR);
            $query->execute();

            $last_insert_id = $db->lastInsertId();
            
            if ($_POST['datenaiss'] < "18" ) {
                header("Location:autorisation.php?last_insert_id=$last_insert_id");
            }
            else {
                header("Location:suivi.php");
            }

        
    }}}
?>

<!DOCTYPE html>
<html lang="fr">
    <?php
include('includes_chant/head-html.php');
?>
<body>
<?php
        require('includes_chant/testmodal.php');
        
    ?>
<div class="container">
    <div class="modform">
        <div class="modalites my-4">
            <img src="images_chant/attention.svg" alt="" width="35em" height="35em" class="mx-3">
            <ul class="mx-3">
                <li>Être agé de 16 minimum.</li>
                <li>Autorisation parentale obligatoire pour les mineur.</li>
                <li>Titre de la chanson a choisir lors de votre inscription et bande son a fournir également lors de votre inscription.</li>
                <li>Sera autorisée une seule chanson par artiste ou groupe d'artistes.</li>
                <li>Le prix d’inscription est de 10€ par candidat.</li>
            </ul>
        </div>
             <?php
            if ($verifEmail !== false && !empty($_POST['email'])) {
                echo('<div class="alert alert-danger" role="alert"> Adresse mail déja prise ! </div>');
            } 
            if ($_POST['datenaiss'] < "16" && !empty($_POST['datenaiss'])) {
                echo('<div class="alert alert-danger" role="alert"> Ce concours est réservé aux plus de 16 ans désolé </div>');
            }                          
            ?>
        <form action="" method="POST" onsubmit="inscription()" class="card-body mt-5">
            <input class="input-group-text" type="text" name="nom" placeholder="Nom">
            <input class="input-group-text" type="text" name="prenom" placeholder="Prénom">
            <input class="input-group-text daten" type="texte" name="datenaiss" placeholder="Âge" width="10rem">
            <input class="input-group-text" type="text" name="email" placeholder="Adresse email">
           
            <div id="test">
            <input class="input-group-text" id="affichemdp" type="password" name="mdp" placeholder="Mot de passe">
            <div >
                <i class="password-icon" data-feather="eye" id="oeil1"></i>
                <i class="password-icon" data-feather="eye-off" id="pasoeil1"></i>
            </div>
            <script src="https://unpkg.com/feather-icons"></script>
            <script>
            feather.replace();
            </script>
            </div>
            <div id="test">
            <input class="input-group-text" id="password2" type="password" name="confirmer" placeholder="Confirmation du mot de passe">
            <div >
                <i class="password-icon" data-feather="eye" id ="oeil2"></i>
                <i class="password-icon" data-feather="eye-off" id="pasoeil2"></i>
            </div>
            <script src="https://unpkg.com/feather-icons"></script>
            <script>
            feather.replace();
            </script>
            </div>
            <button id="envcand" type="submit" class="btn btn-outline-primary my-4">Envoyer la candidature</button>
        </form>
    </div>
</div>


    </div>
    <div>
        <?php include('includes_chant/footer_chant.php');?>
    </div>
</body>
</html>