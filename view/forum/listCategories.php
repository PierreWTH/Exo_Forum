<?php

$categories = $result["data"]["categories"];
    
?>

<div id="categories-page">
    

    <div class="list-categories">
        
    <div><h1>Catégories</h1></div>
<?php
foreach($categories as $categorie ){

    ?>
    <div class = "categorie-items"><p><a href="index.php?ctrl=forum&action=listCategorieTopics&id=<?=$categorie->getId()?>"><?=$categorie->getNomCategorie()?>
    </a> <?php switch ($categorie->getId())
    {
        case 3: ?>
            <i class="fa-solid fa-gamepad"></i>
        <?php 
        break;
        case 4: ?>
            <i class="fa-regular fa-keyboard"></i>
        <?php 
        break;
        case 5: ?>
            <i class="fa-solid fa-car-rear"></i>
        <?php 
        break;
        case 6: ?>
            <i class="fa-solid fa-dumbbell"></i>
        <?php 
        break;
        case 7: ?>
            <i class="fa-solid fa-film"></i>
        <?php 
        break;
        case 8: ?>
            <i class="fa-solid fa-cookie-bite"></i>
        <?php 
            break;?>
        
</p>
</div>

    <?php
    }
}

?>
    </div>
</div>


  
