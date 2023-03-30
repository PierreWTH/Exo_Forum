<h1> Connexion </h1>

<?php if(isset($_SESSION['error'])): ?>

<?= $_SESSION['error']; ?>

<?php unset($_SESSION['error']);
endif; ?>

<form action="index.php?ctrl=security&action=login" method = "post" >
    <input type = "text" name = "email" placeholder = "Entrez un mail">
    <input type = "text" name = "password" placeholder = "Mot de passe">

    <input type="submit" name = "submitLogin" value="Se connecter">
</form>