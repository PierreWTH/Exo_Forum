<H1> MON PROFIL </h1>

<p> Pseudo : <?= App\Session::getUser()->getPseudo()?> </p>
<p> Adresse mail : <?= App\Session::getUser()->getEmail()?> </p>
<p> Staut :  

<?php
// Afficher le statut de l'user
    switch(App\Session::getUser()->getBanStatus())
    {
        case 1:
            echo "Rien a signaler";
            break;

        case 2: 
            echo "Ban leger";
            break;
        
        case 3: 
            echo "Ban moyen";
            break;
        
        case 4:
            echo "Ban lourd";
            break;
    }
?>

</p>