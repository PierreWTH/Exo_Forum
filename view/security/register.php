
<div class = "security-page">
  <div class = "security-h1">
    <h1> Incription </h1>
  </div>

<?php if(isset($_SESSION['error'])): ?>

  <?= $_SESSION['error']; ?>

<?php unset($_SESSION['error']);
endif; ?>

  <div class = "security-form-input">
    <form action="index.php?ctrl=security&action=register" method = "post" >
      <p class = "security-p"> Pseudo </p>
        <input type = "text" name = "pseudo" placeholder = "Choissisez un pseudo">
  </div>
  <div class = "security-form-input">
    <p class = "security-p"> Email </p>
    <input type = "text" name = "email" placeholder = "Entrez votre email">
  </div>
  <div class = "security-form-input">
    <p class = "security-p"> Mot de passe </p>
    <input type = "password" name = "password" placeholder = "Entre un mot de passe">
  </div>
  <div class = "security-form-input">
    <p class = "security-p"> Confirmation </p>
    <input type = "password" name = "confirmPassword" placeholder = "Confirmez votre mdp" >
  </div>

    <input type="submit" name = "submitSignUp" value="S'inscrire">
  </form>
</div>