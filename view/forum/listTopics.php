<?php

$topics = $result["data"]['topics'];
$categories = $result["data"]['categories'];


?>
<div id=list-topics>

    <div class="titre-page">
        <h1>Tous les topics </h1>
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
        foreach($topics as $topic ){?>
        
        <tr>
            <?php if($topic->getLocked() == 0){?>
            <td class="td-topic-details"><i class="fa-regular fa-message"></i></td>
            <?php } 
            else{ ?>
            <td class="td-topic-details"><i class="fa-solid fa-lock"></i></td>
            <?php } ?>
            <td class="td-topic-details"><a href="index.php?ctrl=forum&action=listPosts&id=<?=$topic->getId()?>"><span class = "bold-responsive"><?=$topic->getNomTopic()?></span></a></td>
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

        if ((!isset($_SESSION['user']))) 
        {
            ?>

            <p class = "security-p-topics"> Vous devez être connecté pour ajouter un sujet.</p>
        
        <?php } 

        elseif (App\Session::getUser()->getBanStatus() == 3 || App\Session::getUser()->getBanStatus() == 2) 
        {
            ?>

            <p class = "security-p-topics">Vous avez un banissement léger ou moyen, vous ne pouvez pas poster de topics. </p>


        
        <?php } 



    else 
    {?>

    <div class = "add-topic-form">
        <div class="form-add-topic-top">
            
        <h2 class = "add-topic-h2">Ajouter un sujet</h2>
            <!--Formulaire ajout de topic -->

            <form action="index.php?ctrl=forum&action=addTopic" method = "post" >
                <input type = "text" name = "nomTopic" placeholder = "Titre..." class = "form-input-topic-title">
                <!--Boucle selection des catégories-->
                <select name="categorie_id" class = "form-select-category">
                            <option value="">Catégorie</option>
                            <?php
                        foreach($categories as $categorie){ ?>
                        
                        <option value="<?=$categorie->getId()?>"><?=$categorie->getNomCategorie()?></option>
                    <?php } ?>
                </select>
                <input type="submit" name = "submit" value="Ajouter" class = "form-add-topic-submit">
        </div>
                <div>
                <textarea class = "form-add-topic-textarea" name = "texte" placeholder = "Votre message..." rows = "5" cols = "150"></textarea>
                </div>
                
            </form>
        </div>
    </div>
</div>
  
<?php } 

