<?php
$posts = $result["data"]['posts'];
$topicId = $_GET['id']



?>

<h1>Posts du topic</h1>

<?php
foreach($posts as $post ){

    ?>
    <p><?=$post->getTexte()?>     /     <?=$post->getDateCreationPost()?></p>
    <?php
}
?>

<h2> Ajouter un post </h2>

<!--Formulaire ajout de message -->

<form action="index.php?ctrl=forum&action=addPost&id=<?=$topicId?>" method = "post" >
    <input type = "textarea" name = "texte" placeholder = "Votre message">
    <input type="submit" name = "submit" value="Poster">
</form>
  
