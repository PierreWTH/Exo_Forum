<?php
    namespace Model\Entities;

    use App\Entity;

    final class Topic extends Entity{

        private $id;
        private $nomTopic;
        private $locked;
        private $dateCreationTopic;
        private $user;
        private $categorie;
        private $nbPosts;
        private $lastPost;

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

        // Get value NomTopic
        public function getNomTopic()
        {
                return $this->nomTopic;
        }

        // Set value NomTopic
        public function setNomTopic($nomTopic)
        {
                $this->nomTopic = $nomTopic;

                return $this;
        }

        // Get value Locked
        public function getLocked()
        {
                return $this->locked;
        }

       // Set value Locked
        public function setLocked($locked)
        {
                $this->locked = $locked;

                return $this;
        }

        // Get dateCreationTopic
        public function getDateCreationTopic(){
            $formattedDate = $this->dateCreationTopic->format("d/m/Y, H:i:s");
            return $formattedDate;
        }

        // Set dateCreationTopic
        public function setDateCreationTopic($date){
            $this->dateCreationTopic = new \DateTime($date);
            return $this;
        }

        // Get value User
        public function getUser()
        {
                return $this->user;
        }

        // Set value User
        public function setUser($user)
        {
                $this->user = $user;

                return $this;
        }
        
        // Get value categorie
        public function getCategorie()
        {
                return $this->categorie;
        }

        //  Set value categorie
        public function setCategorie($categorie)
        {
                $this->categorie = $categorie;

                return $this;
        }

        /**
         * Get the value of nbPosts
         */ 
        public function getNbPosts()
        {
                return $this->nbPosts;
        }

        /**
         * Set the value of nbPosts
         *
         * @return  self
         */ 
        public function setNbPosts($nbPosts)
        {
                $this->nbPosts = $nbPosts;

                return $this;
        }

        /**
         * Get the value of lastPost
         */ 
        public function getLastPost()
        {
                return $this->lastPost;
        }

        /**
         * Set the value of lastPost
         *
         * @return  self
         */ 
        public function setLastPost($lastPost)
        {
                $this->lastPost = $lastPost;

                return $this;
        }
    }
