<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$title = "Gestion des candidatures";
session_start();
include('includes_chant/cobdd.php');
include("includes_chant/head-html.php");

$sql = "SELECT * FROM bulletin";
$query = $db->prepare($sql);
$query->execute();
$bulletins = $query->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<body>
    <?php
    require("includes_chant/testmodal.php");
    ?>

    <table>
        <tr>
            <td>ID bulletin</td>
            <td>ID candidat</td>
            <td>Chant</td>
            <td>Etat chant</td>
            <td>Chèque reçu / non reçu</td>
            <td>Paiement validé / refusé</td>
            <td>Accord parental</td>
            <td>Statut validé / refusé / en attente
        </tr>

        <?php
        $i = 0;
            foreach ($bulletins as $bulletin)
            {
                $i = $i + 1;
                echo("<tr>
                <td>{$bulletin['id_bulletin']}</td>

                <td>{$bulletin['id_candidat']}</td>

                <td>{$bulletin['chant']}</td>

                <td>
                    {$bulletin['etatChant']}<br>
                    <form action='upetatchant.php' method='POST'>
                        <input type='hidden' name='bulletin_id' value='{$bulletin['id_bulletin']}'>
                        <input type='submit' name='accept_btn' class='btn btn-outline-success' value='Accepter chant'>
                    </form>
                </td>

                <td>
                    {$bulletin['cheque']}<br>
                    <form action='upcheque.php' method='POST'>
                    <input type='hidden' name='bulletin_id' value='{$bulletin['id_bulletin']}'>
                        <input type='submit' class='btn btn-outline-success')>
                    </form>
                </td>



                <td>
                    {$bulletin['statutPaiement']}<br>
                    <form action='uppaiement.php' method='POST'>
                        <input type='hidden' name='bulletin_id' value='{$bulletin['id_bulletin']}'>
                        <input type='submit' class='btn btn-outline-success' value='Paiement accepté')'>
                    </form>
                </td>
                <td>...</td>
                <td>{$bulletin['statut']}
                    <form action='upstatut.php' method='POST'>
                        <input type='hidden' name='bulletin_id' value='{$bulletin['id_bulletin']}'>
                        <input type='submit' class='btn btn-outline-success' value='Approuver candidature')>
                    </form>
                </td>
                </tr>");
            }
        ?>
    </table>
</body>
</html>