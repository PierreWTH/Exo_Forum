<?php 
$users = $result["data"]['users'];
?>

<h1>Liste des utilisateurs</h1>

<?php
foreach($users as $user ){

    ?>
    <p><?=$user->getPseudo()?>  / <?=$user->getDateInscription()?> </p> 
    
    <!-- Formulaire de banissement -->
    <form action="index.php?ctrl=security&action=banUser&id=<?= $user->getId() ?>" method = "post" > 
    <p> Gerer :
        <select name="level">
                    <option value="">--Choisir--</option>
                    <option value="1">Ban leger</option>
                    <option value="2">Ban moyen</option>
                    <option value="3">Ban lourd</option>
                    <option value="0">Débannir</option>
        </select>
        <input type="submit" name = "submitBan" value="OK">
    </form> </p>

    <?php
}

?>