<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategorieManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){
          

           $topicManager = new TopicManager();
           $categorieManager = new CategorieManager();

            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "categories" => $categorieManager->findAll(),
                    "topics" => $topicManager->findAll(["dateCreationTopic", "DESC"])
                ]
            ];
        
        }
        // Fonction pour lister des catégories 
        public function listCategories()
        {
            $categorieManager = new CategorieManager();

            return [
                "view" => VIEW_DIR."forum/listCategories.php",
                "data" => [
                    "categories" => $categorieManager->findAll(["nomCategorie", ""])
                ]
            ];
        }

        // Fonction pour lister les posts d'un topic

        public function listPosts($id)
        {
            $postManager = new postManager();

            return [
                "view" => VIEW_DIR."forum/listPostsByTopic.php",
                "data" => [
                    "posts" => $postManager->findPostsByTopic($id)
                    
                ]
            ];
        }

        // Fonction pour lister les topics d'une catégorie

        public function listCategorieTopics($id)
        {   
            $categorieManager = new CategorieManager();
            $topicManager = new topicManager();

            return [
                "view" => VIEW_DIR."forum/listTopicsByCategorie.php",
                "data" => [
                    "categories" => $categorieManager->findAll(),
                    "topics" => $topicManager->listTopicsByCategorie($id)
                ]
            ];
        }

        public function addTopic()
        {   

            $topicManager = new TopicManager();
            $postManager = new PostManager();
            $categorieManager = new CategorieManager();

            // Filtrage des données
            if (isset($_POST['submit']))
            {
                
                $nomTopic = filter_input(INPUT_POST, "nomTopic", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $texte = filter_input(INPUT_POST, "texte", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $categorie = filter_input(INPUT_POST, "categorie_id", FILTER_VALIDATE_INT);
                $user = 6;
               
            

                // Vérification des variables épurées

                if ($nomTopic && $texte && $categorie && $user )
                {
                $last_id = $topicManager->add(["nomTopic" => $nomTopic, "user_id" => $user, "categorie_id" => $categorie]);
                $postManager->add(["texte" => $texte, "topic_id" => $last_id, "user_id" => $user]);
                } 

                return [
                    "view" => VIEW_DIR."forum/listTopics.php",
                    "data" => [
                        "categories" => $categorieManager->findAll(),
                        "topics" => $topicManager->findAll(["dateCreationTopic", "DESC"])
                    ]
                ];
            }   
        }

        public function addPost($id)
        {   
            $postManager = new PostManager();

            // Filtrage des données
            if (isset($_POST['submit']))
            {
                $id = (isset($_GET["id"])) ? $_GET["id"] : null ;
                $texte = filter_input(INPUT_POST, "texte", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $topic_id = $id;
                $user = 6;
                

                // Vérification des variables épurées

                if ($texte && $user )
                {
                $postManager->add(["texte" => $texte, "topic_id" => $topic_id, "user_id" => $user]);
                } 

                return [
                    "view" => VIEW_DIR."forum/listPostsByTopic.php",
                    "data" => [
                        "posts" => $postManager->findPostsByTopic($id)
                    ]
                ];
            }   
        }
    }
