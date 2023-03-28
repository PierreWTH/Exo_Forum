<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    
    class HomeController extends AbstractController implements ControllerInterface{

        public function index(){
            
           
                return [
                    "view" => VIEW_DIR."/home/home.php"
                ];
            }
        
        public function rules(){
        
        
            return [
                "view" => VIEW_DIR."home/rules.php"
            ];
        }    

        public function legalNotice(){
        
        
            return [
                "view" => VIEW_DIR."home/legalNotice.php"
            ];
        }  

        public function users(){
            $this->restrictTo("admin");

            $manager = new UserManager();
            $users = $manager->findAll(['dateInscription', 'DESC']);

            return [
                "view" => VIEW_DIR."security/users.php",
                "data" => [
                    "users" => $users
                ]
            ];
        }

        public function forumRules(){
            
            return [
                "view" => VIEW_DIR."rules.php"
            ];
        }

        /*public function ajax(){
            $nb = $_GET['nb'];
            $nb++;
            include(VIEW_DIR."ajax.php");
        }*/
    }
