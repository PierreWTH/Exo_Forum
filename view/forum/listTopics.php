<?php

$topics = $result["data"]['topics'];
$categories = $result["data"]['categories'];


?>
<div id=list-topics>

    <div class="titre-page">
        <h1>Tous les topics </h1>
    </div>

    <div class = "topic-list-details">
    <table>
        <thead>
            <tr>
                <th class="th-topic-details"> Sujet </th>
                <th class="th-topic-details"> Auteur </th>
                <th class="th-topic-details"> Date</th>
                <th class="th-topic-details">Posts</th>
                <?php
                if (isset($_SESSION['user'])){
                if (App\Session::isAdmin()){?>

                <th class="th-topic-details">Supprimer</th>
                
                <?php }}?>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($topics as $topic ){?>
        <tr>
            <td><i class="fa-light fa-messages"></i></td>
            <td class="td-topic-details"><a href="index.php?ctrl=forum&action=listPosts&id=<?=$topic->getId()?>"><?=$topic->getNomTopic()?></a></td>
            <td class="td-topic-details"><?=$topic->getUser()->getPseudo()?></td>
            <td class="td-topic-details"><?=$topic->getDateCreationTopic()?></td>
            <td class="td-topic-details"><?=$topic->getNbPosts()?></td>
        
        
    </div>
            <?php
    
        if (App\Session::isAdmin() || App\Session::getUser() == $topic->getUser()){ ?>

            <td><button><a href = "index.php?ctrl=forum&action=deleteTopic&id=<?=$topic->getId()?>">Supprimer</a></button></td>
        
        <?php } } ?>
            </tr>
        </tbody>
    </table>
    
    
        <?php

        if ((!isset($_SESSION['user']))) 
        {
            ?>
            <p>------------------------------------------------</p>
            <p> Vous devez être connecté pour ajouter un sujet</p>
        
        <?php } 

        elseif (App\Session::getUser()->getBanStatus() == 3 || App\Session::getUser()->getBanStatus() == 2) 
        {
            ?>
            <p>------------------------------------------------</p>
            <p>Vous avec un banissement léger ou moyen, vous ne pouvez pas poster de topics. </p>


        
        <?php } 



    else 
    {?>
    </div>

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
                
                <textarea class = "form-add-topic-textarea" name = "texte" placeholder = "Votre message..." rows = "5" cols = "150"></textarea>
                
                
            </form>
        </div>
    </div>
</div>
  
<?php } 

