<?php
    namespace App;
    use Model\Managers\UserManager;

    abstract class AbstractController{

        public function index(){}
        
        public function redirectTo($ctrl = null, $action = null, $id = null){

                $url = $ctrl ? "?ctrl=".$ctrl : "";
                $url.= $action ? "&action=".$action : "";
                $url.= $id ? "&id=".$id : "";
           
            header("Location: $url");
            die();

        }

        public function restrictTo($role){
            
            if(!Session::getUser() || !Session::getUser()->hasRole($role)){
                $this->redirectTo("security", "loginView");
            }
            return;
        }

    }