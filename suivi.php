<?php
include('includes_chant/cobdd.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
// echo $_SESSION['facture'];
$title = "Suivi du dossier";

$sql='SELECT * FROM `bulletin` WHERE `id_candidat`= :candid';
$query = $db->prepare($sql);
$query->bindValue(':candid',$_SESSION["facture"],PDO::PARAM_STR);
$query->execute();
$suivi = $query->fetch();
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
<div class="d-flex">
    <img class="mx-3" src="images_chant/suivi.svg" alt="">
    <h1>Suivi du dossier</h1>
</div>
    <div class="container d-flex">
        <div class="mx-5 my-5">
            <form action="" class="formapi" method="POST">
                <input class="input-group-text" type="text" name="chanson" placeholder="Titre de la chanson">
                <input type="submit" value="Rechercher le titre" class="btn btn-outline-light mx-5">
            </form>
<!-- ------------------------------------------------ API ---------------------------------------------------------- -->
            <?php
                if(isset($_POST['chanson']))
                {
                    $search = urlencode($_POST['chanson']);
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                    CURLOPT_URL => "https://shazam.p.rapidapi.com/search?term=.$search.&locale=en-US&offset=0&limit=5",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => [
                        "X-RapidAPI-Host: shazam.p.rapidapi.com",
                        "X-RapidAPI-Key: 42005216a6msh161f31e74b16a59p1de906jsna4dcf7ac625c"
                    ],
                    ]);
                    $response = curl_exec($curl);
                    $responsejson = json_decode($response, true);
                    $err = curl_error($curl);
                    curl_close($curl);
                    if ($err) {
                        echo "cURL Error #:" . $err;
                    } else {
                        if (isset($responsejson["tracks"])) {
                            echo("<div class='dataapi'>
                            <form action='' method='POST'>
                                <select class='selectson' name='optionchant' id='select_chansons' onchange='updateImage(this)'>");
                                foreach ($responsejson["tracks"]["hits"] as $hit) {
                                    echo "<option value='" . $hit['track']['title'] . "' data-image='".$hit['track']['images']['coverart']."'>".$hit['track']['title'] . "</option>";
                                }
                                echo("</select>
                                <img id='selectedImage' src='' alt='Image de la chanson'>
                                <input type='submit' value='Envoyer la candidature'>
                                </form>
                            </div>");
                        }
                    }
                }

                if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['optionchant'])){
                    $sql = "INSERT INTO `bulletin` (`id_candidat`, `chant`, `statut`, `id_facture`,`etatChant`, `cheque`, `statutPaiement`) VALUES (:id_candidat, :chant, :statut, :id_facture, :etatChant, :cheque, :statutPaiement)";
                    $query = $db->prepare($sql);
                    $query->bindValue(':id_candidat', $_SESSION['facture'], PDO::PARAM_STR);
                    $query->bindValue(':chant', $_POST['optionchant'], PDO::PARAM_STR);
                    $query->bindValue(':statut', 'Non approuvé', PDO::PARAM_STR);
                    $query->bindValue(':id_facture', "2024".$_SESSION['facture'], PDO::PARAM_STR);
                    $query->bindValue(':etatChant', 'Refusé', PDO::PARAM_STR);
                    $query->bindValue(':cheque', 'Non reçu', PDO::PARAM_STR);
                    $query->bindValue(':statutPaiement', 'Refusé', PDO::PARAM_STR);
                    $query->execute();
                    $insertbulletin = $query->fetch();
                    var_dump($insertbulletin);
                }
            ?>
<!-- ---------------------------------------------------------------------------------------------------------- -->
        </div>
        <div class="suivi">
            <p id="fleche1"><img src="images_chant/flecheverte.svg" alt="fleche validé"> Votre candidature est en train d'être traitée par l'administration</p>
            <p class="affichetexte2" id="affichetext"><img id="fleche2" src="images_chant/flecheverte.svg" alt="fleche validé"> Attente de validation de votre chanson et de votre bande son</p>
            <p class="affichetexte3" id="affichetext"><img id="fleche3" src="images_chant/flecheverte.svg" alt="fleche validé"> Attente de réception du chèque</p>
            <p class="affichetexte4" id="affichetext"><img id="fleche4" src="images_chant/flecheverte.svg" alt="fleche validé"> Vérification du paiement</p>
            <p class="affichetexte5" id="affichetext"><img id="fleche5" src="images_chant/flecheverte.svg" alt="fleche validé"> Bulletin validé, envoi de la facture.<br>
            Bonne chance !</p><br><br>
            <a href="testpdf.php" target="_blank"><button id="facture">Générer votre facture</button></a>      
        </div>
        <?php
            if ($suivi["etatChant"]==='Accepté')
            {
                echo("<script>
                let texte2=document.querySelector('.affichetexte2');
                texte2.style.opacity= 1;
                let fle2=document.querySelector('#fleche2');
                fle2.style.visibility='visible';
                </script>");
            }

            if ($suivi["cheque"]==='Reçu')
            {
                echo("<script>
                let texte3=document.querySelector('.affichetexte3');
                texte3.style.opacity= 1;
                let fle3=document.querySelector('#fleche3');
                fle3.style.visibility='visible';
                </script>");
            }
            if ($suivi["statutPaiement"]==='Accepté')
            {
                echo("<script>
                let texte4=document.querySelector('.affichetexte4');
                texte4.style.opacity= 1;
                let fle4=document.querySelector('#fleche4');
                fle4.style.visibility='visible';
                </script>");
            }
            if ($suivi["statut"]==='Approuvé')
            {
                echo("<script>
                let texte5=document.querySelector('.affichetexte5');
                texte5.style.opacity= 1;
                let fle5=document.querySelector('#fleche5');
                fle5.style.visibility='visible';
                let btnfacture = document.querySelector('#facture');
                btnfacture.style.visibility='visible';
                </script>");
            }

            ?>
    <script>
        function updateImage(select) {
            var selectedImage = document.getElementById('selectedImage');
            var selectedIndex = select.selectedIndex;
            var option = select.options[selectedIndex];
            var imageSrc = option.getAttribute('data-image');
            selectedImage.src = imageSrc;
        }
    </script>


    <div class="fixed-bottom">
        <?php
            include('includes_chant/footer_chant.php');
        ?>
    </div>

</body>
</html>