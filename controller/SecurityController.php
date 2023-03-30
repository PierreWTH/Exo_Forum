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
        // redirection vers page login
        public function loginView()
        {
        
        
            return [
                "view" => VIEW_DIR."security/login.php"
            ];
        }
        // redirection vers page profil
        public function profile()
        {
        
        
            return [
                "view" => VIEW_DIR."security/profile.php"
            ];
        }
        
        // S'inscrire
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
                    // Verification si l'adresse mail existe déja
                    if (!$userManager->findOneByEmail($email))
                    {   
                        // Vérification si le pseudo existe déja
                        if (!$userManager->findOneByPseudo($pseudo))
                        {   
                            // Vérification du mot de passe
                            if (($password == $confirmPassword) and strlen($password) >= 8)
                            {   
                                // hachage du mdp
                                $hash = password_hash($password, PASSWORD_DEFAULT);
                                // ajout de l'user
                                $userManager->add(["email" => $email, "pseudo" => $pseudo, "password" => $hash, "role" => $role]);
                            
                                return [
                                    "view" => VIEW_DIR."security/login.php"
                                ];
                            }   
                                    
                            else
                            {
                                $_SESSION['error'] =  "Le mot de passe doit être identique et contenir 8 caractères minimum. ";
                            }
    
                        }
                        else
                        {
                            $_SESSION['error'] = "Ce pseudo est déja pris. ";
                        }
                    }
                    else
                    {
                        $_SESSION['error'] = "Cet email est déja utilisé. ";
                    }

                    $this->redirectTo("security", "index");
                }
            
            }
        }

        // Se logger 
        public function login()
        {
            $userManager = new UserManager();
            // Verification de l'envoi du form
            if (isset($_POST['submitLogin']))
            { 
                
                    // Epuration des variables
                    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    

                    // Vérification variables épuréees
                    if ($email && $password)
                    { 

                        // Récupération si le mdp existe bien en bdd
                        $dbPass = $userManager->retrievePassword($email);
                        
                        if ($dbPass)
                        {   
                            $user = $userManager ->findOneByEmail($email);
                            $hash = $dbPass->getPassword();

                            // Vérification si le hash corresponds au mdp
                            if (password_verify($password, $hash))
                            {   
                                // Verification que l'email existe bien en bdd
                                if ($userManager->findOneByEmail($email) != NULL )
                                {   
                                    // Récupération du ban status
                                    $banStatus = $userManager->findOneByEmail($email)->getBanStatus();
                                    
                                    // Vérification du ban status
                                    if ($banStatus !=4)
                                    {
                                        Session::setUser($user);
                        
                                        $this->redirectTo("forum", "listTopics");
                                    }
                                    else
                                    {
                                        $_SESSION['error'] = "Vous avez été banni. ";   
                                    }
                                }
                                else
                                {
                                    $_SESSION['error'] = "Adresse mail inconnue. ";   
                                }
                                
                            }
                            else 
                            {
                                $_SESSION['error'] = "Votre mot de passe est incorrect. ";
                            }
                        }
                        else
                        {
                            $_SESSION['error'] = "Votre dentifiant est incorrect. "; 
                        }
                    }
                    else
                    {
                        $_SESSION['error'] = "Les informations que vous avez rentré sont incorrectes. ";
                        
                    }
            
            $this->redirectTo("security", "loginView");    
            
            }
        }

        // Se déconnecter 
        public function logout()
        {
            Session::unsetUser();

            $this->redirectTo("forum", "listTopics");
        }
        

        // Bannir un utilisateur
        public function banUser($id)
        {
            $userManager = new UserManager;

            if (isset($_POST['submitBan']))
            {   
                
                $level = filter_input(INPUT_POST, "level", FILTER_SANITIZE_NUMBER_INT);
                
                if($level)
                {
                    $userManager->userBanner($id, $level);
                    $this->redirectTo("home", "users");

                
                }
            }

        }

    }