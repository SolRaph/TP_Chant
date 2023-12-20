<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
session_start();
    include('includes_chant/cobdd.php');
    require_once('includes_chant/dompdf/autoload.inc.php');
    $title = "Facture";
    ?>

<!DOCTYPE html>
<html lang="en">
<?php
include('includes_chant/head-html.php');
?>
<body>
    <div class="container">
        <h1 class="my-5 mx-5">FACTURE N°:<input class="border-0" type="text"value="<?php
                            
                                echo ($_SESSION["facture"]);
                         ?>"></h1><br>
        <form action="testpdf.php">
            <input class="border-0" type="text" name="prenom" placeholder="prénom" value="<?php
                                echo ($_SESSION["id"]);
                             ?>"><br>
            <input class="border-0" type="text" name="nom" placeholder="Nom" value="<?php
                                echo ($_SESSION["nom"]);
                             ?>"><br>
            <input id="dateInput" class="border-0" name="datejour"> 

            <script>
    // Attendre que le document soit complètement chargé
    document.addEventListener("DOMContentLoaded", function() {
      // Obtenir la date actuelle au format YYYY-MM-DD
      const currentDate = new Date().toISOString().split('T')[0];

      // Sélectionner l'élément d'entrée de date
      const dateInput = document.getElementById("dateInput");

      // Définir la valeur du champ de saisie de date sur la date actuelle
      dateInput.value = currentDate;
    });
  </script>      
        <p id="montant"><span>Montant : 10€</span></p>     
    </form>
    </div>
</body>
</html>