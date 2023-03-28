<?php
$posts = $result["data"]['posts'];
$topicId = $_GET['id'];

// Stockage données dans variable post data

$post_data = [];
foreach($posts as $post ){
    $titre = $post->getTopic()->getNomTopic();
    $locked = $post->getTopic()->getLocked();
    $date = $post->getTopic()->getDateCreationTopic();
    $post_data[] = $post;
}

?>

<!-- Affichage données topics -->

<h1><?= $titre." - ".$date ?></h1>

<?php if(App\Session::isAdmin())
{?>
<button><a href="index.php?ctrl=forum&action=lockTopic&id=<?=$topicId?>">Verouiller le topic</a></button>

<?php
}
?>

<?php
foreach($post_data as $post ){
    
    ?>

    <p><?=$post->getUser()->getPseudo()?>    /    <?=$post->getTexte()?>     /     <?=$post->getDateCreationPost()?> </p>

    <?php
}
?>

<?php

// Vérification si topic est locked

if ($locked == 1)
{
    echo "Ce topic est verouillé. Vous ne pouvez pas répondre. ";
}

// Vérification que la personne est connectée

elseif (!isset($_SESSION['user']))
    {?>
    <p>------------------------------------------------<p>
    <p> Vous devez être connecté pour répondre <p>
    
<?php }


// Si user connecté, et topic pas verouillé, affichage du formulaire
else
{ ?>
<h2> Ajouter un post </h2>

<form action="index.php?ctrl=forum&action=addPost&id=<?=$topicId?>" method = "post" >
    <input type = "textarea" name = "texte" placeholder = "Votre message">
    <input type="submit" name = "submit" value="Poster">
</form>

<?php } ?>

