<H1> MON PROFIL </h1>

<?php 

// Si la personne n'a pas d'avatar
if (App\Session::getUser()->getAvatar() == NULL)
{?>

<p> Ajouter un avatar : </p>

<form action = "index.php?ctrl=security&action=addAvatar&id=<?= App\Session::getUser()->getId() ?>" method = "post">
    <input type="text" name = "avatar" placeholder = "Url Photo">
    <input type="submit" name = "submitAvatar" value ="Ajouter"> 
</form>

<?php }

// Si la personne a déja un avatar
else {
    
?>

<img src=<?=App\Session::getUser()->getAvatar()?>></img>

<form action = "index.php?ctrl=security&action=addAvatar&id=<?= App\Session::getUser()->getId() ?>" method = "post" >
    <input type="text" name = "avatar" placeholder = "Url Photo">
    <input type="submit" name = "submitAvatar" value ="Modifier l'avatar"> 
</form>
<?php }?>

<!-- Afficher infos -->

<p> Pseudo : <?= App\Session::getUser()->getPseudo()?> </p>
<p> Adresse mail : <?= App\Session::getUser()->getEmail()?> </p>
<p> Staut :  

<?php
// Afficher le statut de l'user
    switch(App\Session::getUser()->getBanStatus())
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

</p>