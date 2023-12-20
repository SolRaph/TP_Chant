<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include('includes_chant/cobdd.php');
$title = "Inscription";




if(!empty($_POST['nom'])&&!empty($_POST['prenom'])&&!empty($_POST['email'])&&!empty($_POST['mdp'])&&!empty($_POST['confirmer']))
    {
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
            header("Location:index.php");

            $sql1 = "SELECT * FROM `user` INNER JOIN responsable WHERE user.user_id = responsable.user_id";
            $query = $db->prepare($sql1);
            $query->execute();

    
    // Supposons que $dateNaissance contient la date de naissance au format "Y-m-d"
$dateNaissance = $_POST['datenaiss']; // Assurez-vous de récupérer la date correctement depuis votre formulaire.

// Convertir la date de naissance en objet DateTime
$dateNaissanceObj = new DateTime($dateNaissance);

// Obtenir la date actuelle
$dateActuelle = new DateTime();

// Calculer la différence entre les deux dates pour obtenir l'âge
$age = $dateActuelle->diff($dateNaissanceObj)->y;

// Vérifier si l'âge est inférieur à 18 ans (mineur)
if ($age < 18) {
    
    header("Location: autorisation.php");
    exit();
}
else
{
}}
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

        <form action="" method="POST" onsubmit="inscription()" class="card-body mt-5">
            <input class="input-group-text" type="text" name="nom" placeholder="Nom">
            <input class="input-group-text" type="text" name="prenom" placeholder="Prénom">
            <input class="input-group-text daten" type="date" name="datenaiss" placeholder="Date de naissance" width="10rem">
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