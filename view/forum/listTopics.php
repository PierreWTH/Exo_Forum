<?php

$topics = $result["data"]['topics'];
$categories = $result["data"]['categories'];
?>

<h1>Liste topics</h1>

<?php
foreach($topics as $topic ){

    ?>
    <p><a href="index.php?ctrl=forum&action=listPosts&id=<?=$topic->getId()?>"><?=$topic->getNomTopic()?>  /  <?=$topic->getDateCreationTopic()?> <a></p>
    <?php
}

?>

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
  
