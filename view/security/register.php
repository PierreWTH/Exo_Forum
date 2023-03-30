
<h1> Incription </h1>

<?php if(isset($_SESSION['error'])): ?>

  <?= $_SESSION['error']; ?>

<?php unset($_SESSION['error']);
endif; ?>


<form action="index.php?ctrl=security&action=register" method = "post" >
    <input type = "text" name = "pseudo" placeholder = "Entrez un pseudo">
    <input type = "text" name = "email" placeholder = "Entrez votre email">
    <input type = "password" name = "password" placeholder = "Mot de passe">
    <input type = "password" name = "confirmPassword" placeholder = "Confirmation mdp" >

    <input type="submit" name = "submitSignUp" value="S'inscrire">
</form>