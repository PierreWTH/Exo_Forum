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



<!--Formulaire ajout de topic -->

<?php

if (isset($_SESSION['user']))
{

?>

<h2>Ajouter un sujet</h2>

<form action="index.php?ctrl=forum&action=addTopic" method = "post" >
    <input type = "text" name = "nomTopic" placeholder = "Entrez le titre">
    <input type = "textarea" name = "texte" placeholder = "Votre message">
    <input type="hidden" name="categorie_id" value= "<?=$categorieId?>">   

    <input type="submit" name = "submit" value="Ajouter à la catégorie">
</form>
  
<?php } 

else 
{?>
<p>------------------------------------------------<p>
<p> Vous devez être connecté pour ajouter un sujet <p>

<?php } ?>