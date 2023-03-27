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

        public function loginView()
        {
        
        
            return [
                "view" => VIEW_DIR."security/login.php"
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
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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
                            
                                return [
                                    "view" => VIEW_DIR."security/login.php"
                                ];
                            }   
                                    
                            else
                            {
                                echo  "Le mot de passe doit être identique et contenir 8 caractères minimum. ";
                            }
    
                        }
                        else
                        {
                           echo "Ce pseudo est déja pris. ";
                        }
                    }
                    else
                    {
                       echo "Cet email est déja utilisé. ";
                    }

                    return [
                        "view" => VIEW_DIR."security/register.php"
                    ];
                }
            
            }
        }

        public function login()
        {
            $userManager = new UserManager();
            // Verification de l'envoi du form
            if (isset($_POST['submitSignUp']))
            {   
                // Epuration des variables
                $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                
                // Vérification variables épuréees
                if ($email && $password)
                {   
                    // Récupération si le mdp existe bien en bdd
                    $dbPass = $userManager->retrievePassword($email);

                    if ($dbPass)
                    {
                        $hash = $dbPass->getPassword();
                        // Vérification si le hash corresponds au mdp
                        if (password_verify($password, $hash))
                        {
                            $token = generateToken();
                        }
                    }

                }
            }
                
        }
            

    }