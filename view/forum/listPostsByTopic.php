<?php
$posts = $result["data"]['posts'];
$topicId = $_GET['id']



?>

<h1>Posts du topic</h1>

<?php
foreach($posts as $post ){

    $locked = $post->getTopic()->getLocked()
    ?>

    <p><?=$post->getTexte()?>     /     <?=$post->getDateCreationPost()?> </p>

    <?php
}
?>

<?php

// Vérification si topic est locked

if ($locked == 1)
{
    echo "Ce topic est verouillé. Vous ne pouvez pas ajouter de post. ";
}

else 
{ ?>
<h2> Ajouter un post </h2>

<!--Formulaire ajout de message -->

<form action="index.php?ctrl=forum&action=addPost&id=<?=$topicId?>" method = "post" >
    <input type = "textarea" name = "texte" placeholder = "Votre message">
    <input type="submit" name = "submit" value="Poster">
</form>

<?php } ?>

