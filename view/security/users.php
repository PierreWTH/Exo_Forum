<?php 
$users = $result["data"]['users'];
?>

<h1>Liste des utilisateurs</h1>

<?php
foreach($users as $user ){

    ?>
    <p><?=$user->getPseudo()?>  / <?=$user->getDateInscription()?> / Email : <?=$user->getEmail()?> / 
    
    <?php 
    // Afficher le statut de l'user
    switch($user->getBanStatus())
    {
        case 1:
            echo "Rien a signaler";
            break;

        case 2: 
            echo "Ban leger";
            break;
        
        case 3: 
            echo "Ban moyen";
            break;
        
        case 4:
            echo "Ban lourd";
            break;
    }
    
     ?>
    
    <!-- Formulaire de banissement -->
    <form action="index.php?ctrl=security&action=banUser&id=<?= $user->getId() ?>" method = "post" > 
    <p> Gerer :
        <select name="level">
                    <option value="">--Choisir--</option>
                    <option value="2">Ban leger</option>
                    <option value="3">Ban moyen</option>
                    <option value="4">Ban lourd</option>
                    <option value="1">Débannir</option>
        </select>
        <input type="submit" name = "submitBan" value="OK">
    </form> </p>

    <?php
}

?>