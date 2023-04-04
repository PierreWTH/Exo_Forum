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
<div id = "list-posts-page">

<!-- Affichage données topics -->
<div class = "titre-page">
    <h1><?= $titre ?></h1>
</div>

<div class = "lock-topic">
<?php 
if(App\Session::isAdmin())
{?>
<button class = "form-add-topic-submit"><a href="index.php?ctrl=forum&action=lockTopic&id=<?=$topicId?>">Verouiller le topic</a></button>

<?php

    if($locked == 1)
    {?>
    <button class = "form-add-topic-submit"><a href="index.php?ctrl=forum&action=unlockTopic&id=<?=$topicId?>">Dévérouiller le topic</a></button>

    <?php
    }
}?>
</div>


<?php
foreach($post_data as $post ){
    
    ?>
    <div class = "body-message">

        <div class = "message-info"> <p>
            <span class = "user-info-background">
            <?php if ($post->getUser()->getAvatar() != NULL){?>
            <img class ="post-user-avatar" src="<?=$post->getUser()->getAvatar()?>" alt=""> <?php }
            else {?>
            <i class="fa-solid fa-user"></i>
            <?php } ?>
                <?=$post->getUser()->getPseudo()?></p></span>     <span class = "user-info-background" ><p><?=$post->getDateCreationPost()?>
        
    
        <?php if (App\Session::isAdmin() || App\Session::getUser() == $post->getUser()){ ?>
        <a href = "index.php?ctrl=forum&action=deletePost&id=<?=$post->getId()?>"><i class="fa-regular fa-trash-can"></i></a>
        <?php } 
        if (App\Session::getUser() == $post->getUser() && $locked != 1){ ?>
        <a href = "index.php?ctrl=forum&action=updatePostPage&id=<?=$post->getId()?>"><i class="fa-regular fa-pen-to-square"></i></a></p>
        <span>
        
        <?php } ?>
        </div>

        <span class = "post-text"><?=$post->getTexte()?> </span>
        
        </div>

<?php }  ?>
    
  

    
    

<?php

// Vérification si topic est locked

if ($locked == 1)
{?>
    
    <p class = "security-p-topics"> Ce topic est verouillé. </p>
    
<?php }

// Vérification que la personne est connectée

elseif (!isset($_SESSION['user']))
    {?>

    <p class = "security-p-topics"> Vous devez être connecté pour répondre </p>
    
<?php }

// Vérification du statut

elseif (App\Session::getUser()->getBanStatus() == 3)
    {?>

    <p class = "security-p-topics"> Vous ne pouvez pas répondre, vous avez un ban moyen. </p>
    
<?php }

// Si user connecté, pas banni et topic pas verouillé, affichage du formulaire
else
{ ?>
<div class = "add-topic-form">
    <div class="form-add-post-top">

        <h2 class = "add-topic-h2"> Ajouter un post </h2>

        <form action="index.php?ctrl=forum&action=addPost&id=<?=$topicId?>" method = "post" >
    
            <input type="submit" name = "submit" value="Poster" class = "form-add-topic-submit">
        </div>
        <div class = "textearea-add-post">
            <textarea class = "form-add-topic-textarea" name = "texte" placeholder = "Votre message..." rows = "5" cols = "150"></textarea>
            </div>
        </form>
    </div>
</div>

<?php } ?>

</div>

