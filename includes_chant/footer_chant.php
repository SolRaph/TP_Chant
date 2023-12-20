

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
