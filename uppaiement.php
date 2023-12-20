<?php
include('includes_chant/cobdd.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
        echo "Formulaire soumis";
        $bulletin_id = $_POST['bulletin_id'];
        echo $bulletin_id;
        $sql = "UPDATE `bulletin` SET `statutPaiement` = 'Accepté' WHERE `id_bulletin` = $bulletin_id";
        $query = $db->prepare($sql);
        $sql = $query->execute();
        header('Location: admin.php');
        } else {
            echo "Erreur lors de la mise à jour.";
        }
?>