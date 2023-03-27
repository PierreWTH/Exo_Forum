<?php

$topics = $result["data"]['topics'];
$categorieId = (isset($_GET["id"])) ? $_GET["id"] : null ;;
?>

<h1>Topics de la catégorie</h1>

<?php
foreach($topics as $topic ){

    ?>
    <p><a href="index.php?ctrl=forum&action=listPosts&id=<?=$topic->getId()?>"><?=$topic->getNomTopic()?></a></p>
    <?php
}

?>

<h2>Ajouter un sujet</h2>

<!--Formulaire ajout de topic -->


<form action="index.php?ctrl=forum&action=addTopic" method = "post" >
    <input type = "text" name = "nomTopic" placeholder = "Entrez le titre">
    <input type = "textarea" name = "texte" placeholder = "Votre message">
    <input type="hidden" name="categorie_id" value= "<?=$categorieId?>">   

    <input type="submit" name = "submit" value="Ajouter">
</form>
  
