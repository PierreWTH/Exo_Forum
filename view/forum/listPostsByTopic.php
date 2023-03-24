<?php

$posts = $result["data"]['posts'];



?>

<h1>Posts du topic</h1>

<?php
foreach($posts as $post ){

    ?>
    <p><?=$post->getTexte()?>     /     <?=$post->getDateCreationPost()?></p>
    <?php
}


  
