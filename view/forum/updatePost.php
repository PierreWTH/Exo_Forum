<?php 
$texte = $result["data"]['texte'];
$postId = $_GET['id'];

 ?>
 <div class = "message-update">

<h1 class = "titre-page"> MODIFIER LE MESSAGE </h1>

<form action="index.php?ctrl=forum&action=updatePost&id=<?=$postId?>" method = "post" >
    <textarea class ="update-textarea"  name = "texte" placeholder = "Votre message..." rows = "5" cols = "150"><?=$texte;?></textarea>
    <div class = "submit-update">
    <input class = "form-update-post" type="submit" name = "submitUpdate" value="Modifier">
    </div>
</form>
</div>