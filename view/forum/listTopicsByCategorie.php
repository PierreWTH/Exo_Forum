<?php

$topics = $result["data"]['topics'];
$categorieId = (isset($_GET["id"])) ? $_GET["id"] : null;

if (!empty($topics)){
    $topic_data = [];
    foreach($topics as $topic ){
        $categorie = $topic->getCategorie()->getNomCategorie();
        $topic_data[] = $topic;
    }
}

// Si il n'y a pas de topic dans la catégorie et que le user n'est pas co
if (empty($topics)&& !isset($_SESSION['user']))
{?>
    <p> Cette catégorie ne comporte pas encore de topic. <p>
    <p> -------------------------------------------------<p>
    <p> Vous devez être connecté pour ajouter un topic. <p>
    
    <?php }
// Si il n'y a pas de topic dans la catégorie et que le user est co
else if (empty($topics) && isset($_SESSION['user']))
{?>
    <p> Cette catégorie ne comporte pas encore de topic. <p>

    <h2>Ajouter un sujet</h2>

    <form action="index.php?ctrl=forum&action=addTopic" method = "post" >
        <input type = "text" name = "nomTopic" placeholder = "Entrez le titre">
        <input type = "textarea" name = "texte" placeholder = "Votre message">
        <input type="hidden" name="categorie_id" value= "<?=$categorieId?>">   
    
        <input type="submit" name = "submit" value="Ajouter à la catégorie">
    </form>  
<?php }
// Si il ya des topics dans la catégorie
else 
{ ?>

<h1><?= $categorie ?></h1>

<?php
foreach($topic_data as $topic ){
 
    ?>
    <p><a href="index.php?ctrl=forum&action=listPostsByTopicCategorie&id=<?=$topic->getId()?>"><?=$topic->getNomTopic()?></a>
    <?php

 if (App\Session::isAdmin() || App\Session::getUser() == $topic->getUser()){ ?>

    <button><a href = "index.php?ctrl=forum&action=deleteTopicByCategorie&id=<?=$topic->getId()?>">Supprimer</a></button></p>

<?php } } 


    // Si l'utilisateur est connecté
    if (isset($_SESSION['user']))
    {

    ?>
    <!--Formulaire ajout de topic -->

    <h2>Ajouter un sujet</h2>

    <form action="index.php?ctrl=forum&action=addTopic" method = "post" >
        <input type = "text" name = "nomTopic" placeholder = "Entrez le titre">
        <input type = "textarea" name = "texte" placeholder = "Votre message">
        <input type="hidden" name="categorie_id" value= "<?=$categorieId?>">   

        <input type="submit" name = "submit" value="Ajouter à la catégorie">
    </form>
    
    <?php } 
    // Affichage d'un message si user pas connecté
    else 
    {?>
    <p>------------------------------------------------<p>
    <p> Vous devez être connecté pour ajouter un sujet <p>

    <?php } } ?>