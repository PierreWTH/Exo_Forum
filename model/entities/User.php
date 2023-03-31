<?php
    namespace Model\Entities;

    use App\Entity;

    final class User extends Entity
    {

        private $id;
        private $pseudo;
        private $dateInscription;
        private $password;
        private $role;
        private $email;
        private $banStatus;
        private $avatar;

        public function __construct($data){         
            $this->hydrate($data);        
        }

        // GETTERS & SETTERS

        // Get value ID 
        public function getId()
        {
                return $this->id;
        }

        // Set value ID
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        //Get value pseudo
        public function getPseudo()
        {
                return $this->pseudo;
        }

        // Set value Pseudo
        public function setPseudo($pseudo)
        {
                $this->pseudo = $pseudo;

                return $this;
        }

        // Get date inscription

        public function getDateInscription(){
            $formattedDate = $this->dateInscription->format("d/m/Y, H:i:s");
            return $formattedDate;
        }

        // Set date inscription

        public function setDateInscription($date){
            $this->dateInscription = new \DateTime($date);
            return $this;
        }

        // Get value Password
        public function getPassword()
        {
                return $this->password;
        }

        // Set value Password
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        // Get value role
        public function getRole()
        {
                return $this->role;
        }

        // Set value role
        public function setRole($role)
        {
                $this->role = $role;

                return $this;
        }

        public function hasRole($role)
        {
                return $this->role === $role;
        }

       

        

        // Get email
        public function getEmail()
        {
                return $this->email;
        }

        // Set email
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

       

        // Get banStatus
        public function getBanStatus()
        {
                return $this->banStatus;
        }

       // Set banStatus
        public function setBanStatus($banStatus)
        {
                $this->banStatus = $banStatus;

                return $this;
        }

        /**
         * Get the value of avatar
         */ 
        public function getAvatar()
        {
                return $this->avatar;
        }

        /**
         * Set the value of avatar
         *
         * @return  self
         */ 
        public function setAvatar($avatar)
        {
                $this->avatar = $avatar;

                return $this;
        }
    }