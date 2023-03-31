<?php

$topics = $result["data"]['topics'];
$categories = $result["data"]['categories'];
?>

<h1>Tous les topics </h1>

<?php
foreach($topics as $topic ){

    ?>
    <p><a href="index.php?ctrl=forum&action=listPosts&id=<?=$topic->getId()?>"><?=$topic->getNomTopic()?></a>  / <?=$topic->getUser()->getPseudo()?> / <?=$topic->getDateCreationTopic()?> / Posts : <?=$topic->getNbPosts()?>
    <?php

 if (App\Session::isAdmin() || App\Session::getUser() == $topic->getUser()){ ?>

    <button><a href = "index.php?ctrl=forum&action=deleteTopic&id=<?=$topic->getId()?>">Supprimer</a></button></p>

<?php } } ?>

<?php

if ((!isset($_SESSION['user']))) 
{
    ?>
    <p>------------------------------------------------<p>
    <p> Vous devez être connecté pour ajouter un sujet<p>
    
<?php } 

elseif (App\Session::getUser()->getBanStatus() == 3 || App\Session::getUser()->getBanStatus() == 2) 
{
    ?>
    <p>------------------------------------------------<p>
    <p>Vous avec un banissement léger ou moyen, vous ne pouvez pas poster de topics. <p>
    
<?php } 

else 
{?>

<h2>Ajouter un sujet</h2>

<!--Formulaire ajout de topic -->

<form action="index.php?ctrl=forum&action=addTopic" method = "post" >
    <input type = "text" name = "nomTopic" placeholder = "Entrez le titre">
    <input type = "textarea" name = "texte" placeholder = "Votre message">

    <!--Boucle selection des catégories-->

    <select name="categorie_id" placeholder = "Catégorie">
                <option value="">Catégorie</option>
                <?php
            foreach($categories as $categorie){ ?>
            
            <option value="<?=$categorie->getId()?>"><?=$categorie->getNomCategorie()?></option>
        <?php } ?>
    </select>

    <input type="submit" name = "submit" value="Ajouter">
</form>
  
<?php } 

