<H1> MON PROFIL </h1>

<p> Pseudo : <?= App\Session::getUser()->getPseudo()?> </p>
<p> Email : <?= App\Session::getUser()->getEmail()?> </p>
<p> Staut : <?= App\Session::getUser()->getBanStatus()?> </p>

