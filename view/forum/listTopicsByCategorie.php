<?php

$topics = $result["data"]['topics'];

?>

<h1>Topics de la catégorie</h1>

<?php
foreach($topics as $topic ){

    ?>
    <p><a href="index.php?ctrl=forum&action=listPosts&id=<?=$topic->getId()?>"><?=$topic->getNomTopic()?></a></p>
    <?php
}


  