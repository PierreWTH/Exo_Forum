<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    
    class SecurityController extends AbstractController implements ControllerInterface{

        public function index()
            {
            
           
                return [
                    "view" => VIEW_DIR."security/register.php"
                ];
            }
        
        
        public function register()
        {   
            // Verif si le formulaire est envoyé
            if (isset($_POST['submitSignUp']))
            {   
                // Epuration des variables
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
                
                $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                var_dump($pseudo);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                var_dump($password);
                $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                var_dump($confirmPassword);
                $role = "member";
            
                // Verification des variables épurées
                if ($email && $pseudo && $password)
                {
                    $userManager = new userManager();

                    if (!$userManager->findOneByEmail($email))
                    {
                        if (!$userManager->findOneByPseudo($pseudo))
                        {
                            if (($password == $confirmPassword) and strlen($password) >= 8)
                            {
                                $hash = password_hash($password, PASSWORD_DEFAULT);

                                $userManager->add(["email" => $email, "pseudo" => $pseudo, "password" => $hash, "role" => $role]);
                            }
                        }
                    }


                    $this->redirectTo("security", "index");

                }
            
            
            
            
            
            
            
            
            
            
            
            
            }
        }
            

    }