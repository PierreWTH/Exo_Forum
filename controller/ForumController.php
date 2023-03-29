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

            // Filtrage des données et on s'assure que l'utilisateur est bien connecté
            if (isset($_POST['submit']) && isset($_SESSION['user']))
            {
                $nomTopic = filter_input(INPUT_POST, "nomTopic", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $texte = filter_input(INPUT_POST, "texte", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $categorie = filter_input(INPUT_POST, "categorie_id", FILTER_VALIDATE_INT);
                $user = Session::getUser()->getId();
               
            

                // Vérification des variables épurées

                if ($nomTopic && $texte && $categorie && $user ) 
                {
                $last_id = $topicManager->add(["nomTopic" => $nomTopic, "user_id" => $user, "categorie_id" => $categorie]);
                $postManager->add(["texte" => $texte, "topic_id" => $last_id, "user_id" => $user]);
                } 

                if ($_POST['submit'] == "Ajouter")
                {

                    $this->redirectTo("forum", "listTopics");
                }

                else 
                {
                    $this->redirectTo("forum", "listCategorieTopics", $categorie);
                }

            }   
        }

        // Ajouter un post
        public function addPost($id)
        {   
            $postManager = new PostManager();

            // Filtrage des données et on s'assure que l'utilisateur est bien connecté
            if (isset($_POST['submit']) && isset($_SESSION['user']))
            {
                $id = (isset($_GET["id"])) ? $_GET["id"] : null ;
                $texte = filter_input(INPUT_POST, "texte", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $topic_id = $id;
                $user = Session::getUser()->getId();
                

                // Vérification des variables épurées

                if ($texte && $user )
                {
                $postManager->add(["texte" => $texte, "topic_id" => $topic_id, "user_id" => $user]);
                } 

                $this->redirectTo("forum", "listPosts", $id);
                
            }   
        }
        
        // Verouiller un topic 
        public function lockTopic($id)
        {
            if (isset($_SESSION['user']))
            {
                $topicManager = new TopicManager();

                $topicManager-> topicLocker($id);
                
                $this->redirectTo("forum", "listPosts", $id);
            }
            else 
            {
                $this->redirectTo("forum", "listPosts", $id);
            }
        }

        // Dévérouiller un topic
        public function unlockTopic($id)
        {   // On s'assure que l'utilisateur est bien connecté 
            if (isset($_SESSION['user']))
            {
                $topicManager = new TopicManager();

                $topicManager-> topicUnlocker($id);
                
                $this->redirectTo("forum", "listPosts", $id);
            }
            else 
            {
                $this->redirectTo("forum", "listPosts", $id);
            }
        }

        // Supprimer un post 
        public function deletePost($id)
        
        {  if (isset($_SESSION['user']))
            {
                $postManager = new postManager();

                $topicId = $postManager->findOneByid($id)->getTopic()->getId();

                $postManager-> postDeleter($id);
                
                $this->redirectTo("forum", "listPosts", $topicId);
            }
            else 
            {
                $this->redirectTo("forum", "listTopics");
            }
    

        }
    
        // Supprimer topic 
        public function deleteTopic($id)
        
        {  
            if (isset($_SESSION['user']))
            {

            $topicManager = new topicManager();

            $topicManager-> topicDeleter($id);
            
            $this->redirectTo("forum", "listTopics");
            }
            else 
            {
                $this->redirectTo("forum", "listPosts", $topicId);
            }
        }
    
    
    
    
    
    }
