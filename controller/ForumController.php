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
            $topicManager = new topicManager();

            return [
                "view" => VIEW_DIR."forum/listTopicsByCategorie.php",
                "data" => [
                    "topics" => $topicManager->listTopicsByCategorie($id)
                ]
            ];
        }

        public function addTopic()
        {   

            $topicManager = new TopicManager();
            $categorieManager = new CategorieManager();

            // Filtrage des données
            if (isset($_POST['submit']))
            {
                
                $nomTopic = filter_input(INPUT_POST, "nomTopic", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                var_dump($nomTopic);
                $texte = filter_input(INPUT_POST, "texte", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                var_dump($texte);
                $categorie = filter_input(INPUT_POST, "categorie_id", FILTER_VALIDATE_INT);
                var_dump($categorie);
                $user = 6;
                var_dump($user);
            

                // Vérification des variables épurées

                if ($nomTopic && $texte && $categorie && $user )
                {
                $topicManager->add(["nomTopic" => $nomTopic, "user_id" => $user, "categorie_id" => $categorie]);
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
    }
