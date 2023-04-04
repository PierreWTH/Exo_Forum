<div id = list-topics>

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
    <p> Vous devez être connecté pour ajouter un topic. <p>
    
    <?php }
// Si il n'y a pas de topic dans la catégorie et que le user est co
else if (empty($topics) && isset($_SESSION['user']))
{?>
    <p class ="security-p-topics"> Cette catégorie ne comporte pas encore de topic. <p>

<div class = "add-topic-form">
    <div class = form-add-topic-top>
    <h2 class = add-topic-h2>Ajouter un sujet</h2>

    <form action="index.php?ctrl=forum&action=addTopic" method = "post" >
        <input class = "form-input-topic-title"type = "text" name = "nomTopic" placeholder = "Entrez le titre">
        
        <input type="hidden" name="categorie_id" value= "<?=$categorieId?>">   
    
        <input class = "form-add-topic-submit" type="submit" name = "submit" value="Ajouter à la catégorie">
     
    </div> 
    <textarea class = "form-add-topic-textarea" name = "texte" placeholder = "Votre message..." rows = "5" cols = "150"></textarea>
    </form>
</div>
<?php }
// Si il ya des topics dans la catégorie
else 
{ ?>
<div class = "titre-page">
<h1><?= $categorie ?></h1>
</div>
<div class = "topic-list-details">
    <table class = "responsive-table">
        <thead>
            <tr>
                <th class="th-topic-details"></th>
                <th class="th-topic-details"> Auteur </th>
                <th class="th-topic-details"> Pseudo</th>
                <th class="th-topic-details">Date</th>
                <th class="th-topic-details"><i class="fa-regular fa-comment-dots"></i></th>
                <th class="th-topic-details">Dernier Post</th>
                <?php
                if (isset($_SESSION['user'])){
                if (App\Session::isAdmin()){?>

                <th class="th-topic-details">Gérer</th>
                
                <?php }}?>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($topic_data as $topic ){?>
        <tr>
            <?php if($topic->getLocked() == 0){?>
            <td class="td-topic-details"><i class="fa-regular fa-message"></i></td>
            <?php } 
            else{ ?>
            <td class="td-topic-details"><i class="fa-solid fa-lock"></i></td>
            <?php } ?>
            <td class="td-topic-details"><a href="index.php?ctrl=forum&action=listPostsByTopicCategorie&id=<?=$topic->getId()?>"><span class = "bold-responsive"><?=$topic->getNomTopic()?></span></a></td>
            <td class="td-topic-details"><?=$topic->getUser()->getPseudo()?></td>
            <td class="td-topic-details1"><?=$topic->getDateCreationTopic()?></td>
            <td class="td-topic-details1"><?=$topic->getNbPosts()?></td>
            <td class="td-topic-details1"><?=$topic->getLastPost()?></td>
        
        
    
            <?php
    
        if (App\Session::isAdmin() || App\Session::getUser() == $topic->getUser()){ ?>

            <td class="td-topic-details"><a href = "index.php?ctrl=forum&action=deleteTopic&id=<?=$topic->getId()?>"><i class="fa-regular fa-trash-can"></i></a></td>
        
        <?php } } ?>
            </tr>
        </tbody>
    </table>
    </div>

<?php
    // Si l'utilisateur est connecté
    if (isset($_SESSION['user']))
    {

    ?>
    <!--Formulaire ajout de topic -->

    <div class = "add-topic-form">
        <div class = form-add-topic-top>
        <h2 class = add-topic-h2>Ajouter un sujet</h2>

        <form action="index.php?ctrl=forum&action=addTopic" method = "post" >
            <input type = "text" name = "nomTopic" placeholder = "Entrez le titre" class= " form-input-topic-title">
            
            <input type="hidden" name="categorie_id" value= "<?=$categorieId?>">   
        
            <input type="submit" name = "submit" value="Ajouter à la catégorie" class = "form-add-topic-submit"> 
        
        </div> 
        <textarea class = "form-add-topic-textarea" name = "texte" placeholder = "Votre message..." rows = "5" cols = "150"></textarea>
        </form>
    </div>
    
    <?php } 
    // Affichage d'un message si user pas connecté
    else 
    {?>
    <p class = "security-p-topics"> Vous devez être connecté pour ajouter un sujet <p>

    <?php } } ?>

</div>