

<div class = "profile-page">
<h1 class = "titre-page"> MON PROFIL </h1>

<div class  = "contenu-profile">

<div>
<?php 

// Si la personne n'a pas d'avatar
if (App\Session::getUser()->getAvatar() == NULL)
{?>

<span class = "add-avatar-p"><p> Ajouter un avatar : </p><span>

<form action = "index.php?ctrl=security&action=addAvatar&id=<?= App\Session::getUser()->getId() ?>" method = "post">
    <input type="text" name = "avatar" placeholder = "Url Photo">
    <input type="submit" name = "submitAvatar" value ="Ajouter" class = "form-add-topic-submit"> 
</form>

<?php }

// Si la personne a déja un avatar
else {
    
?>

<img src=<?=App\Session::getUser()->getAvatar()?> class = "avatar"></img>

<form action = "index.php?ctrl=security&action=addAvatar&id=<?= App\Session::getUser()->getId() ?>" method = "post" >
    <input type="text" name = "avatar" placeholder = "Lien photo..." class = "form-input-avatar">
    <input type="submit" name = "submitAvatar" value ="Modifier l'avatar" class = "form-add-topic-submit"> 
</form>

<?php }?>
</div>
<!-- Afficher infos -->
<div>
<p> <span class = "bold">Pseudo : </span><?= App\Session::getUser()->getPseudo()?> </p>
<p> <span class = "bold">Adresse mail :</span> <?= App\Session::getUser()->getEmail()?> </p>
<p> <span class = "bold">Staut : </span> 

<?php
// Afficher le statut de l'user
    switch(App\Session::getUser()->getBanStatus())
    {
        case 1:
            ?>   Rien a signaler  <i class="fa-regular fa-circle-check"></i></p><?php
            break;

        case 2: 
            ?>  Bannissement léger  <i class="fa-solid fa-circle-half-stroke"></i></p> <?php
            break;
        
        case 3: 
            ?>  Bannissement moyen  <i class="fa-solid fa-circle"></i> </p><?php
            break;
        
        case 4:
            ?> Banissement lourd  <i class="fa-solid fa-circle-xmark"> </i></p> <?php
            break;
    }
?>


        </div>
    </div>
</div>