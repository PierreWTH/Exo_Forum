 <div class = "security-page">
        <div class = "security-h1">
        <h1> Connexion </h1>
        </div>

        <?php if(isset($_SESSION['error'])): ?>

        <?= $_SESSION['error']; ?>

        <?php unset($_SESSION['error']);
        endif; ?>
        <div class = "security-form-input">
            <form action="index.php?ctrl=security&action=login" method = "post" >
                <p class = "security-p"> Email </p>
                <input type = "text" name = "email" placeholder = "Entrez votre mail" required>
        </div>
        <div class = "security-form-input">
            <p class = "security-p"> Mot de passe </p>
            <input type = "password" name = "password" placeholder = "Entrez votre mot de passe" required>
        </div>
        <div>
            <input type="submit" name = "submitLogin" value="Se connecter">
        </form>
        </div>
    </div>
