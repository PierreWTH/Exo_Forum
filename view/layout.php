<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="public/css/style.css">
    <title>FORUM</title>
</head>
<body>
    <div id="wrapper"> 
       
        <div id="mainpage">
            <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
            <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
            <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
            <header>
                <nav>
                    <div id="nav-left">
                        <a href="index.php?ctrl=home&action=index" id="forum-logo">FORUM</a>
                        <?php
                        if(App\Session::isAdmin()){
                            ?>
                            <a href="index.php?ctrl=home&action=users" class= "a-liste-user">Liste des utilisateurs</a>
                          
                            <?php
                        }
                        ?>
                    </div>
                    <div id="nav-right">
                    <?php
                        
                        if(App\Session::getUser()){
                            ?>
                            <a href="index.php?ctrl=forum&action=listTopics">Tous les topics</a>
                            <a href="index.php?ctrl=forum&action=listCategories">Catégories</a>
                            <a href="index.php?ctrl=security&action=profile" class="navbar-a-background"><span class="fas fa-user"></span>&nbsp;<?= App\Session::getUser()->getPseudo()?></a>
                            <a href="index.php?ctrl=security&action=logout"class="navbar-a-background">Déconnexion</a>
                            <?php
                        }
                        else{
                            ?>
                            <a href="index.php?ctrl=forum&action=listTopics">Tous les topics</a>
                            <a href="index.php?ctrl=forum&action=listCategories">Catégories</a>
                            <a href="index.php?ctrl=security&action=loginView"class="navbar-a-background">Connexion</a>
                            <a href="index.php?ctrl=security&action=index"class="navbar-a-background">Inscription</a>
                        <?php
                        }
                   
                        
                    ?>
                    </div>
                    </nav>
                     <!-- Top Navigation Menu -->
                    <div class="topnav">
                    <a href="index.php?ctrl=home&action=index" class="active">FORUM</a>
                    <!-- Navigation links (hidden by default) -->
                    <div id="myLinks">
                    <?php
                        
                        if(App\Session::getUser()){
                            ?>
                            <a href="index.php?ctrl=forum&action=listTopics">Tous les topics</a>
                            <a href="index.php?ctrl=forum&action=listCategories">Catégories</a>
                            <a href="index.php?ctrl=security&action=profile" ><span class="fas fa-user"></span>&nbsp;<?= App\Session::getUser()->getPseudo()?></a>
                            <a href="index.php?ctrl=security&action=logout">Déconnexion</a>
                            <?php

                            if(App\Session::isAdmin()){
                                ?>
                                <a href="index.php?ctrl=home&action=users" class= "a-liste-user">Liste des utilisateurs</a>
                              
                                <?php
                            }
                            
                        }
                        else{
                            ?>
                            <a href="index.php?ctrl=forum&action=listTopics">Tous les topics</a>
                            <a href="index.php?ctrl=forum&action=listCategories">Catégories</a>
                            <a href="index.php?ctrl=security&action=loginView">Connexion</a>
                            <a href="index.php?ctrl=security&action=index">Inscription</a>
                        <?php
                        }
                   
                        
                    ?>
                    </div>
                    <!-- "Hamburger menu" / "Bar icon" to toggle the navigation links -->
                    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                        <i class="fa fa-bars"></i>
                    </a>
                    </div>
                
            </header>
            
            <main id="forum">
                <?= $page ?>
            </main>
        </div>
        <footer>
            <div><p>&copy; 2023 - PierreWTH </div><div>|</div><div><p><a href="index.php?ctrl=home&action=rules">Règlement du forum</a></p></div><div>|</div> <div><p><a href="index.php?ctrl=home&action=legalNotice">Mentions légales</a></p></div>
            <!--<button id="ajaxbtn">Surprise en Ajax !</button> -> cliqué <span id="nbajax">0</span> fois-->
        </footer>
    </div>
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <script>

        $(document).ready(function(){
            $(".message").each(function(){
                if($(this).text().length > 0){
                    $(this).slideDown(500, function(){
                        $(this).delay(3000).slideUp(500)
                    })
                }
            })
            $(".delete-btn").on("click", function(){
                return confirm("Etes-vous sûr de vouloir supprimer?")
            })
            tinymce.init({
                selector: '.post',
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
                content_css: '//www.tiny.cloud/css/codepen.min.css'
            });
        })

        

        /*
        $("#ajaxbtn").on("click", function(){
            $.get(
                "index.php?action=ajax",
                {
                    nb : $("#nbajax").text()
                },
                function(result){
                    $("#nbajax").html(result)
                }
            )
        })*/
    </script>
    <script>
        function myFunction() {
  var x = document.getElementById("myLinks");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
        </script>
</body>
</html>